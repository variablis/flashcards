<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Deck;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FlashcardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => 'q '.fake()->words(5, true),
            'answer' => 'a '. fake()->words(5, true),
            'times_viewed' => fake()->randomNumber(3),
            'times_answered' => fake()->randomNumber(2),
            
            'deck_id' => Deck::all()->random()->id
        ];
    }
}
