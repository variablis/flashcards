<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'topic '.fake()->words(3, true),
            'description' => fake()->words(7, true),

            'user_id' => User::all()->where('is_admin', 0)->random()->id,
            'category_id' => Category::all()->random()->id
        ];
    }
}
