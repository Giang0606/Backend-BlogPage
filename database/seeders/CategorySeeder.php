<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = \Faker\Factory::create(); 

        $categories = [];
        $categories_type = ['Travel', 'Food', 'Technology', 'Business', 'Another category'];
        
        for ($i = 0; $i < 5; $i++) {
            array_push($categories, 
            [
                'category_name' => $categories_type[$i],
                'description' => $fake->realText(300),
            ]);
        }
        
        if(Category::count() == 0) {
            Category::insert(
                $categories
            );
        }
    }
}
