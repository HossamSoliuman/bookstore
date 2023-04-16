<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email='admin@gmail.com';
        User::factory(1)->create([
            'name'=>'admin',
            'role' =>'admin',
            'email' => $email,
            'password' => Hash::make($email),
        ]);
    }
}
