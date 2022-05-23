<?php

namespace Database\Seeders;

use App\Models\User; 
use App\Models\Post; 
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
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

        for($i = 0; $i < 50; $i++) {
            Comment::create([
                'post_id' => rand(1, $countPost), 
                'user_id' => rand(1, $countUser), 
                'content' => $fake->realText(rand(1, 10000)), 
            ]);
        }
    }
}
