<?php

namespace Database\Seeders;

use App\Models\Users;
use App\Models\Images;
use App\Models\Interest;
use App\Models\RelationshipGoal;
use App\Models\Religion;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyUsersSeeder extends Seeder
{
    public function run()
    {
        $dummyUsers = [
            ['fullname' => 'Emma Johnson', 'gender' => 2, 'about' => 'Love hiking and photography 📸', 'bio' => 'Adventure seeker'],
            ['fullname' => 'Sophia Williams', 'gender' => 2, 'about' => 'Coffee enthusiast ☕', 'bio' => 'Living my best life'],
            ['fullname' => 'Olivia Brown', 'gender' => 2, 'about' => 'Yoga lover 🧘‍♀️', 'bio' => 'Peace and positivity'],
            ['fullname' => 'Isabella Davis', 'gender' => 2, 'about' => 'Bookworm 📚', 'bio' => 'Lost in stories'],
            ['fullname' => 'Mia Garcia', 'gender' => 2, 'about' => 'Foodie & traveler ✈️', 'bio' => 'Exploring the world'],
            ['fullname' => 'James Wilson', 'gender' => 1, 'about' => 'Gym & fitness 💪', 'bio' => 'Health is wealth'],
            ['fullname' => 'Liam Anderson', 'gender' => 1, 'about' => 'Music lover 🎵', 'bio' => 'Life is a melody'],
            ['fullname' => 'Noah Martinez', 'gender' => 1, 'about' => 'Tech enthusiast 💻', 'bio' => 'Building the future'],
            ['fullname' => 'William Taylor', 'gender' => 1, 'about' => 'Sports fanatic ⚽', 'bio' => 'Game on!'],
            ['fullname' => 'Benjamin Lee', 'gender' => 1, 'about' => 'Nature photographer 🌿', 'bio' => 'Capturing moments'],
        ];

        foreach ($dummyUsers as $userData) {
            $user = new Users();
            $user->identity = 'FAKE' . strtoupper(Str::random(8));
            $user->fullname = $userData['fullname'];
            $user->gender = $userData['gender'];
            $user->about = $userData['about'];
            $user->bio = $userData['bio'];
            $user->dob = now()->subYears(rand(22, 35))->format('Y-m-d');
            $user->password = bcrypt('password123');
            $user->is_verified = 2;
            $user->can_go_live = 2;
            $user->is_fake = 1;
            $user->country = 'United States';
            $user->state = 'California';
            $user->city = 'Los Angeles';

            // Random interests
            $interestIds = Interest::inRandomOrder()->limit(rand(3, 5))->pluck('id')->toArray();
            $user->interests = implode(',', $interestIds);

            // Gender preferred (1=Male, 2=Female, 3=Both)
            $user->gender_preferred = rand(1, 3);

            // Relationship goal
            $relationshipGoal = RelationshipGoal::inRandomOrder()->first();
            if ($relationshipGoal) {
                $user->relationship_goal_id = $relationshipGoal->id;
            }

            // Religion
            $religion = Religion::inRandomOrder()->first();
            if ($religion) {
                $user->religion_key = $religion->title;
            }

            // Languages
            $languages = Language::inRandomOrder()->limit(rand(1, 3))->pluck('title')->toArray();
            $user->language_keys = implode(',', $languages);

            $user->save();

            $this->command->info("Created dummy user: {$userData['fullname']}");
        }

        $this->command->info('10 dummy users created successfully!');
    }
}
