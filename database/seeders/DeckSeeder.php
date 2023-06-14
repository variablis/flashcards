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
        // Deck::create(['title' => 'Deck name 1', 'description' => 'Some deck description', 'progress'=> 0, 'count' => 5, 'topic_id'=>1]);
    }
}
