<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookLanguage;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(LanguageSeeder::class);
        User::factory(50)->create();
        $this->call(AdminSeeder::class);
        Author::factory(50)->create();
        Book::factory(50)->create();
        
        
        Cart::factory(500)->create();
        Order::factory(2000)->create();
        Review::factory(500)->create();
        BookCategory::factory(100)->create();
        BookLanguage::factory(100)->create();

        
    }
}
