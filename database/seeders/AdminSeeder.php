<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'name'=>'admin',
            'role' =>'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin@gmail.com',
        ]);
    }
}
