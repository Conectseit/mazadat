<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'name_ar' => 'المملكة العربية السعودية',
            'name_en' => 'Kingdom of Saudi Arabia',
            'phone_code' => '+966',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
