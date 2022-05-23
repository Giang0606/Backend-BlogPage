<?php

namespace Database\Seeders;

use App\Models\RoleUser; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(RoleUser::count() == 0) {
            RoleUser::insert([
                [
                    'user_type' => 'admin', 
                    'role_number' => 1,
                ],
                [
                    'user_type' => 'modder',
                    'role_number' => 2, 
                ], 
                [
                    'user_type' => 'user', 
                    'role_number' => 3,
                ],
            ]);
        }
    }
}
