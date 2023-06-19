<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Topic;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deck>
 */
class DeckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'deck '. fake()->words(3, true),
            'description' => fake()->words(7, true),
            'progress' => fake()->randomNumber(2),
            'count' => fake()->randomNumber(2),

            'topic_id' => Topic::all()->random()->id,
            'tag_id' => Tag::all()->random()->id
        ];
    }
}
