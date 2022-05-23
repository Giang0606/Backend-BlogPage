<?php

namespace Database\Seeders;

use App\Models\User; 
use App\Models\RoleUser;
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
        if(User::count() == 0) {
            User::insert([
                [
                    'username_login' => "admin", 
                    'email' => "admin@gmail.com", 
                    'password' => bcrypt("admin12345"), 
                    'role' => 1,
                ],
                [
                    'username_login' => "modder", 
                    'email' => "modder@gmail.com", 
                    'password' => bcrypt("modder12345"), 
                    'role' => 2,
                ],
                [
                    'username_login' => "user", 
                    'email' => "user@gmail.com", 
                    'password' => bcrypt("user12345"), 
                    'role' => 3,
                ]
            ]); 
        }

        $fake = \Faker\Factory::create(); 

        // $n = RoleUser::select('role_number')->inRandomOrder()->first(); 
        // echo gettype($n);
        
        for ($i = 0; $i < 15; $i++){
            User::create([
                'name' => $fake->name, 
                'birth_of_date' => $fake->dateTimeBetween('1930-01-01', '2010-12-31'),
                'nickname' => $fake->name, 
                'username_login' => $fake->unique()->userName,
                'email' => $fake->unique()->email,
                'address' => $fake->address,
                'phone_number' => $fake->phoneNumber, 
                'password' => $fake->password,
                'role' => RoleUser::select('role_number')->inRandomOrder()->first()['role_number'],
            ]);
        }
    }
}
