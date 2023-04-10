<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book_categories = array("Fiction", "Non-Fiction", "Mystery", "Romance", "Sci-Fi", "Biography", "History", "Travel");
        foreach ($book_categories as $book_category) {
            DB::table('categories')->insert([
                'name' => $book_category
            ]);
        }
    }
}
