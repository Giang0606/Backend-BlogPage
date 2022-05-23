<?php

namespace Database\Seeders;

use App\Models\User; 
use App\Models\Post; 
use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = \Faker\Factory::create(); 
        $countUser = User::count(); 
        $countPost = Post::count();
        $likeable = array("like", "dislike");

        for($i = 0; $i < 50; $i++) {
            $likeableNum = array_rand($likeable, 1);

            Like::create([
                'user_id' => rand(1, $countUser), 
                'likeable_id' => rand(1, $countPost), 
                'likeable_type' => $likeable[$likeableNum], 
            ]);
        }
    }
}
