<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'math'], 
            ['name' => 'language'],
            ['name' => 'english'],
            ['name' => 'git'],
            ['name' => 'laravel'],
            ['name' => 'spanish'],
        ];

        DB::table('tags')->insert($tags);
    }
}
