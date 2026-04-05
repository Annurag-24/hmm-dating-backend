<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BunnyCDNService
{
    private $storageZone;
    private $storagePassword;
    private $storageHostname;
    private $cdnUrl;

    // Bunny Stream (Video)
    private $streamLibraryId;
    private $streamApiKey;
    private $streamCdnHostname;

    public function __construct()
    {
        // Storage (Images)
        $this->storageZone = env('BUNNY_STORAGE_ZONE', 'user-profile-storage');
        $this->storagePassword = env('BUNNY_STORAGE_PASSWORD');
        $this->storageHostname = env('BUNNY_STORAGE_HOSTNAME', 'storage.bunnycdn.com');
        $this->cdnUrl = env('BUNNY_CDN_URL', 'https://user-profile-storage.b-cdn.net');

        // Stream (Videos)
        $this->streamLibraryId = env('BUNNY_STREAM_LIBRARY_ID', '585122');
        $this->streamApiKey = env('BUNNY_STREAM_API_KEY');
        $this->streamCdnHostname = env('BUNNY_STREAM_CDN_HOSTNAME', 'vz-e0f5144c-d28.b-cdn.net');
    }

    /**
     * Generate upload info for mobile (industry standard approach)
     * Returns minimal info - mobile uploads directly, sends back path only
     *
     * @param string $type Type of file (image, video, profile, story, post, verification)
     * @param int|null $userId User ID for folder organization
     * @return array
     */
    public function generateUploadUrl($type = 'image', $userId = null)
    {
        $timestamp = time();
        $randomString = bin2hex(random_bytes(8));

        // Determine folder based on type
        $folder = match($type) {
            'profile' => 'profiles',
            'story' => 'stories',
            'post' => 'posts',
            'verification' => 'verifications',
            'video' => 'videos',
            default => 'uploads',
        };

        // Add user folder if provided
        if ($userId) {
            $folder = "{$folder}/{$userId}";
        }

        // Generate unique filename with extension placeholder
        $fileName = "{$timestamp}_{$randomString}";
        $path = "{$folder}/{$fileName}";

        if ($type === 'video') {
            return [
                'type' => 'video',
                'storage_type' => 'bunny_stream',
                'upload_url' => "https://video.bunnycdn.com/library/{$this->streamLibraryId}/videos",
                'headers' => [
                    'AccessKey' => $this->streamApiKey,
                    'Content-Type' => 'application/json',
                ],
                'library_id' => $this->streamLibraryId,
                'path' => $path,
            ];
        }

        // Image: Return full upload URL with access key in headers
        $uploadUrl = "https://{$this->storageHostname}/{$this->storageZone}/{$path}";

        return [
            'type' => 'image',
            'storage_type' => 'bunny_storage',
            'upload_url' => $uploadUrl,
            'headers' => [
                'AccessKey' => $this->storagePassword,
                'Content-Type' => 'application/octet-stream',
            ],
            'path' => $path,
        ];
    }

    /**
     * Get CDN configuration for mobile app
     * Mobile stores this and uses to construct full URLs
     *
     * @return array
     */
    public static function getCdnConfig()
    {
        return [
            'image_cdn_url' => env('BUNNY_CDN_URL', 'https://user-profile-storage.b-cdn.net'),
            'video_cdn_url' => 'https://' . env('BUNNY_STREAM_CDN_HOSTNAME', 'vz-e0f5144c-d28.b-cdn.net'),
            'storage_hostname' => env('BUNNY_STORAGE_HOSTNAME', 'storage.bunnycdn.com'),
            'storage_zone' => env('BUNNY_STORAGE_ZONE', 'user-profile-storage'),
        ];
    }

    /**
     * Construct full CDN URL from path (for backend use)
     *
     * @param string|null $path
     * @param string $type 'image' or 'video'
     * @return string|null
     */
    public static function getFullUrl($path, $type = 'image')
    {
        if (empty($path)) {
            return null;
        }

        // If already a full URL, return as is
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if ($type === 'video') {
            $cdnHostname = env('BUNNY_STREAM_CDN_HOSTNAME', 'vz-e0f5144c-d28.b-cdn.net');
            return 'https://' . $cdnHostname . '/' . ltrim($path, '/');
        }

        $cdnUrl = env('BUNNY_CDN_URL', 'https://user-profile-storage.b-cdn.net');
        return rtrim($cdnUrl, '/') . '/' . ltrim($path, '/');
    }

    /**
     * Transform array of paths to full URLs
     *
     * @param array $paths
     * @param string $type
     * @return array
     */
    public static function getFullUrls($paths, $type = 'image')
    {
        if (empty($paths)) {
            return [];
        }

        return array_map(function ($path) use ($type) {
            return self::getFullUrl($path, $type);
        }, $paths);
    }

    /**
     * Upload a file to Bunny CDN Storage (server-side upload)
     *
     * @param string $localPath Full local path to the file
     * @param string $remotePath Path in Bunny storage
     * @return string|false Returns path on success, false on failure
     */
    public function uploadFile($localPath, $remotePath)
    {
        if (!$this->storagePassword) {
            Log::warning('BunnyCDN: Storage password not configured');
            return false;
        }

        try {
            $url = "https://{$this->storageHostname}/{$this->storageZone}/{$remotePath}";
            $fileContent = file_get_contents($localPath);

            $response = Http::withHeaders([
                'AccessKey' => $this->storagePassword,
                'Content-Type' => 'application/octet-stream',
            ])->withBody($fileContent, 'application/octet-stream')
              ->put($url);

            if ($response->successful()) {
                Log::info("BunnyCDN: File uploaded - {$remotePath}");
                return $remotePath; // Return path only, not full URL
            } else {
                Log::error("BunnyCDN: Upload failed - " . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error("BunnyCDN: Upload exception - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete a file from Bunny CDN Storage
     *
     * @param string $remotePath Path in Bunny storage
     * @return bool
     */
    public function deleteFile($remotePath)
    {
        if (!$this->storagePassword || empty($remotePath)) {
            return false;
        }

        // Skip if it's a full URL from old storage
        if (str_starts_with($remotePath, 'http')) {
            return true; // Consider it deleted (old storage)
        }

        try {
            $url = "https://{$this->storageHostname}/{$this->storageZone}/{$remotePath}";

            $response = Http::withHeaders([
                'AccessKey' => $this->storagePassword,
            ])->delete($url);

            if ($response->successful()) {
                Log::info("BunnyCDN: File deleted - {$remotePath}");
                return true;
            } else {
                Log::error("BunnyCDN: Delete failed - " . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error("BunnyCDN: Delete exception - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if Bunny CDN Storage is configured
     *
     * @return bool
     */
    public function isConfigured()
    {
        return !empty($this->storagePassword) && !empty($this->storageZone);
    }

    /**
     * Check if Bunny Stream is configured
     *
     * @return bool
     */
    public function isStreamConfigured()
    {
        return !empty($this->streamApiKey) && !empty($this->streamLibraryId);
    }

    /**
     * Get CDN URL (for backward compatibility)
     *
     * @param string $remotePath
     * @return string
     */
    public function getCdnUrl($remotePath)
    {
        return self::getFullUrl($remotePath, 'image');
    }
}
