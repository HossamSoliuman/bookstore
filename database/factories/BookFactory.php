<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(4),
            'price' => rand(20, 70),
            'details' => fake()->text(),
            'publisher' => fake()->sentence(2),
            'description' => fake()->text(),
            'cover_url' => 'book_covers/cover.png',
            'book_url' => 'books/book.pdf',
        ];
    }
}
