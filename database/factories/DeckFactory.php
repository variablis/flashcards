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
            'title' => ucfirst('deck '. fake()->words(rand(1, 5), true)),
            'description' => ucfirst('deck description '. fake()->words(rand(1, 12), true)),

            'topic_id' => Topic::all()->random()->id,
            'tag_id' => Tag::all()->random()->id
        ];
    }
}
