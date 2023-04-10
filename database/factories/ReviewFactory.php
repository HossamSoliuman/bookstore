<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number_of_stars' => fake()->rand(1,5),
            'book_id' => fake()->rand(1,50),
            'user_id' => fake()->rand(1,50),
            'review' =>fake()->sentence(10),
        ];
    }
}
