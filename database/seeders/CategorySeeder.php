<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Mathematics'], 
            ['name' => 'Languages'],
            ['name' => 'Technology and Engineering'],
            ['name' => 'Science'],
            ['name' => 'Health and Fitness'],
            ['name' => 'Business and Finance'],
            ['name' => 'Art'],
            ['name' => 'Medical'],
            ['name' => 'Professional'],
            ['name' => 'Food'],
            ['name' => 'Law'],
            
            ['name' => 'Uncatogarized'],
        ];

        DB::table('categories')->insert($categories);
    }
}
