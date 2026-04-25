<?php

namespace Database\Seeders;

use App\Models\Images;
use App\Models\Interest;
use App\Models\Language;
use App\Models\RelationshipGoal;
use App\Models\Religion;
use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestUsersSeeder extends Seeder
{
    public function run()
    {
        $interestIds = Interest::inRandomOrder()->limit(4)->pluck('id')->toArray();
        $relationshipGoalId = RelationshipGoal::inRandomOrder()->value('id');
        $religionKey = Religion::inRandomOrder()->value('title') ?? 'Prefer not to say';
        $languageKeys = Language::inRandomOrder()->limit(2)->pluck('title')->toArray();

        $accounts = [
            [
                'identity'             => 'test_user_001@hmm.app',
                'username'             => 'testuser001',
                'fullname'             => 'Alex Carter',
                'gender'               => 1,
                'dob'                  => '1995-06-15',
                'bio'                  => 'Software engineer by day, guitarist by night',
                'about'                => 'I love building things, jamming out, and exploring new places. Looking for someone who shares the same curiosity about the world.',
                'country'              => 'United States',
                'state'                => 'California',
                'city'                 => 'San Francisco',
                'lattitude'            => '37.7749',
                'longitude'            => '-122.4194',
                'gender_preferred'     => 2,
                'age_preferred_min'    => 22,
                'age_preferred_max'    => 32,
                'distance_preference'  => 50,
                'religion_key'         => $religionKey,
                'language_keys'        => implode(',', $languageKeys),
                'relationship_goal_id' => $relationshipGoalId,
                'interests'            => implode(',', $interestIds),
                'instagram'            => 'alex.carter',
                'image_source'         => base_path('uifaces-cartoon-avatar.jpg'),
            ],
            [
                'identity'             => 'test_user_002@hmm.app',
                'username'             => 'testuser002',
                'fullname'             => 'Jordan Lee',
                'gender'               => 2,
                'dob'                  => '1997-03-22',
                'bio'                  => 'Traveller, foodie, and book lover',
                'about'                => 'Always planning the next trip. I believe the best conversations happen over good food. Big fan of cozy cafes and indie films.',
                'country'              => 'United States',
                'state'                => 'New York',
                'city'                 => 'New York City',
                'lattitude'            => '40.7128',
                'longitude'            => '-74.0060',
                'gender_preferred'     => 1,
                'age_preferred_min'    => 24,
                'age_preferred_max'    => 35,
                'distance_preference'  => 30,
                'religion_key'         => $religionKey,
                'language_keys'        => implode(',', $languageKeys),
                'relationship_goal_id' => $relationshipGoalId,
                'interests'            => implode(',', $interestIds),
                'instagram'            => 'jordan.lee',
                'image_source'         => base_path('committee-member-3.png'),
            ],
        ];

        foreach ($accounts as $data) {
            $existing = Users::where('identity', $data['identity'])->first();
            if ($existing) {
                $this->command->warn("Skipping {$data['fullname']} — already exists.");
                continue;
            }

            $user = new Users();
            $user->identity            = $data['identity'];
            $user->username            = $data['username'];
            $user->fullname            = $data['fullname'];
            $user->gender              = $data['gender'];
            $user->dob                 = $data['dob'];
            $user->bio                 = $data['bio'];
            $user->about               = $data['about'];
            $user->country             = $data['country'];
            $user->state               = $data['state'];
            $user->city                = $data['city'];
            $user->lattitude           = $data['lattitude'];
            $user->longitude           = $data['longitude'];
            $user->gender_preferred    = $data['gender_preferred'];
            $user->age_preferred_min   = $data['age_preferred_min'];
            $user->age_preferred_max   = $data['age_preferred_max'];
            $user->distance_preference = $data['distance_preference'];
            $user->religion_key        = $data['religion_key'];
            $user->language_keys       = $data['language_keys'];
            $user->relationship_goal_id = $data['relationship_goal_id'];
            $user->interests           = $data['interests'];
            $user->instagram           = $data['instagram'];
            $user->password            = bcrypt('Test@1234');
            $user->login_type          = 4;
            $user->is_verified         = 2;
            $user->can_go_live         = 2;
            $user->is_fake             = 0;
            $user->show_on_map         = 1;
            $user->is_notification     = 1;
            $user->is_video_call       = 1;
            $user->wallet              = 0;
            $user->app_language        = 'en';
            $user->save();

            // Copy image into storage and create Images record
            $imagePath = $data['image_source'];
            if (file_exists($imagePath)) {
                $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
                $filename  = Str::random(40) . '.' . $extension;
                $stored    = Storage::disk('public')->put(
                    'uploads/' . $filename,
                    file_get_contents($imagePath)
                );

                if ($stored) {
                    $image          = new Images();
                    $image->user_id = $user->id;
                    $image->image   = 'uploads/' . $filename;
                    $image->save();
                } else {
                    $this->command->warn("Could not store image for {$data['fullname']}.");
                }
            } else {
                $this->command->warn("Image not found at {$imagePath} for {$data['fullname']}.");
            }

            $this->command->info("Created test user: {$data['fullname']} (identity: {$data['identity']}, password: Test@1234)");
        }

        $this->command->info('Test users seeded successfully!');
    }
}
