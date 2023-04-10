<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = array("Arabic", "English", "French", "German", "Spanish");
        foreach ($languages as $language) {
            DB::table('languages')->insert([
                'name' => $language
            ]);
        }

         
    }
}
