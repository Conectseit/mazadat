<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('nationalities')->insert([
            'name_ar' => 'سعودي',
            'name_en' => 'Saudi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('nationalities')->insert([
            'name_ar' => 'إماراتي',
            'name_en' => 'Emirates',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('nationalities')->insert([
            'name_ar' => 'مصري',
            'name_en' => 'Egyptian',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
