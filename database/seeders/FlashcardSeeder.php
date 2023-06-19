<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class FlashcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('flashcards')->insert([
            'question' => 'admin',
            'answer' => 'admin@localhost',
            'times_viewed' => 0,
            'times_answered' => 0,
            'deck_id' => 1
        ]);
    }
}
