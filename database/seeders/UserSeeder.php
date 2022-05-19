<?php

namespace Database\Seeders;

use App\Models\User; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = \Faker\Factory::create(); 

        for ($i = 0; $i < 15; $i++){
            User::create([
                'name' => $fake->name, 
                'email' => $fake->unique()->email,
                'password' => bcrypt("123456"),
            ]);
        }
    }
}
