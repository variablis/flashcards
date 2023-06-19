<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Deck;

class DeckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Deck::create([
            'title' => 'Default Deck', 
            'description' => 'Default deck description', 
            'progress'=> 0, 
            'count' => 0, 
            'topic_id'=>1,
            'tag_id'=>1
        ]);
    }
}
