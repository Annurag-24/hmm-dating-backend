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

class RealUsersProfileSeeder extends Seeder
{
    public function run()
    {
        $interestIds        = Interest::inRandomOrder()->limit(4)->pluck('id')->toArray();
        $relationshipGoalId = RelationshipGoal::inRandomOrder()->value('id');
        $religionKey        = Religion::inRandomOrder()->value('title') ?? 'Prefer not to say';
        $languageKeys       = Language::inRandomOrder()->limit(2)->pluck('title')->toArray();

        $profiles = [
            [
                'identity'             => 'annurag2402@gmail.com',
                'fullname'             => 'Anurag Singh',
                'gender'               => 1,
                'dob'                  => '1998-04-24',
                'bio'                  => 'Building things, one commit at a time',
                'about'                => 'Tech enthusiast and travel lover. Always up for a good conversation and new experiences.',
                'country'              => 'India',
                'state'                => 'Delhi',
                'city'                 => 'New Delhi',
                'lattitude'            => '28.6139',
                'longitude'            => '77.2090',
                'gender_preferred'     => 2,
                'age_preferred_min'    => 22,
                'age_preferred_max'    => 30,
                'distance_preference'  => 50,
                'religion_key'         => $religionKey,
                'language_keys'        => implode(',', $languageKeys),
                'relationship_goal_id' => $relationshipGoalId,
                'interests'            => implode(',', $interestIds),
                'image_source'         => base_path('uifaces-cartoon-avatar.jpg'),
            ],
            [
                'identity'             => 'flowcrm6@gmail.com',
                'fullname'             => 'Flow User',
                'gender'               => 2,
                'dob'                  => '1997-08-10',
                'bio'                  => 'Explorer at heart, coffee in hand',
                'about'                => 'Passionate about art, travel, and meeting interesting people. Let\'s share stories over chai.',
                'country'              => 'India',
                'state'                => 'Maharashtra',
                'city'                 => 'Mumbai',
                'lattitude'            => '19.0760',
                'longitude'            => '72.8777',
                'gender_preferred'     => 1,
                'age_preferred_min'    => 24,
                'age_preferred_max'    => 35,
                'distance_preference'  => 30,
                'religion_key'         => $religionKey,
                'language_keys'        => implode(',', $languageKeys),
                'relationship_goal_id' => $relationshipGoalId,
                'interests'            => implode(',', $interestIds),
                'image_source'         => base_path('committee-member-3.png'),
            ],
        ];

        foreach ($profiles as $data) {
            $user = Users::where('identity', $data['identity'])->first();

            if (!$user) {
                $this->command->error("User not found for identity: {$data['identity']} — skipping.");
                continue;
            }

            $user->fullname             = $data['fullname'];
            $user->gender               = $data['gender'];
            $user->dob                  = $data['dob'];
            $user->bio                  = $data['bio'];
            $user->about                = $data['about'];
            $user->country              = $data['country'];
            $user->state                = $data['state'];
            $user->city                 = $data['city'];
            $user->lattitude            = $data['lattitude'];
            $user->longitude            = $data['longitude'];
            $user->gender_preferred     = $data['gender_preferred'];
            $user->age_preferred_min    = $data['age_preferred_min'];
            $user->age_preferred_max    = $data['age_preferred_max'];
            $user->distance_preference  = $data['distance_preference'];
            $user->religion_key         = $data['religion_key'];
            $user->language_keys        = $data['language_keys'];
            $user->relationship_goal_id = $data['relationship_goal_id'];
            $user->interests            = $data['interests'];
            $user->is_verified          = 2;
            $user->can_go_live          = 2;
            $user->show_on_map          = 1;
            $user->is_notification      = 1;
            $user->is_video_call        = 1;
            $user->save();

            // Add profile image only if user has none
            $hasImage = Images::where('user_id', $user->id)->exists();
            if (!$hasImage) {
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
                        $this->command->info("Image added for {$data['identity']}");
                    } else {
                        $this->command->warn("Could not store image for {$data['identity']}.");
                    }
                } else {
                    $this->command->warn("Image file not found at {$imagePath}");
                }
            } else {
                $this->command->warn("Image already exists for {$data['identity']} — skipping image.");
            }

            $this->command->info("Profile updated: {$data['identity']}");
        }

        $this->command->info('Real users profile seeding complete.');
    }
}
