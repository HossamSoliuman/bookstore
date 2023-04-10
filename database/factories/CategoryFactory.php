<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
         $book_categories = array("Fiction", "Non-Fiction", "Mystery", "Romance", "Sci-Fi", "Biography", "History", "Travel");

        return [
            'name'=> fake()->randomElement($book_categories),
        ];
    }
}
