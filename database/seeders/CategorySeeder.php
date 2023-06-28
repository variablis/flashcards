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
            ['name' => 'Art'],
            ['name' => 'Business and finance'],
            ['name' => 'Food'],
            ['name' => 'Health and fitness'],
            ['name' => 'Languages'],
            ['name' => 'Law'],
            ['name' => 'Mathematics'],
            ['name' => 'Medical'],
            ['name' => 'Professional'],
            ['name' => 'Science'],
            ['name' => 'Technology and engineering'],
            ['name' => 'Other'],
        ];

        DB::table('categories')->insert($categories);
    }
}
