<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::create([
            'title' => 'Datori', 
            'description' => 'Neliels apraksts šeit', 
            'user_id'=> 2,
            'category_id' => 12,
        ]);
    }
}
