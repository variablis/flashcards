<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,

            TopicSeeder::class,
            DeckSeeder::class,
        ]);

        \App\Models\User::factory(50)->create();

        \App\Models\Topic::factory(400)->create();
        \App\Models\Deck::factory(800)->create();
        \App\Models\Flashcard::factory(9000)->create();
    }
}
