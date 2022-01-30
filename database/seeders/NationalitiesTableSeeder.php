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
        DB::table('nationalities')->insert([
            'name_ar' => 'كويتي',
            'name_en' => 'kiwaytiun',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('nationalities')->insert([
            'name_ar' => 'قطري',
            'name_en' => 'qatari',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('nationalities')->insert([
            'name_ar' => 'جزائري',
            'name_en' => 'jazayiriun',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('nationalities')->insert([
            'name_ar' => 'عماني',
            'name_en' => 'Omani',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('nationalities')->insert([
            'name_ar' => 'سوري',
            'name_en' => 'Syrian',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('nationalities')->insert([
            'name_ar' => 'لبناني',
            'name_en' => 'Lebanese',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('nationalities')->insert([
            'name_ar' => 'فلسطيني',
            'name_en' => 'Palestinian',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('nationalities')->insert([
            'name_ar' => 'ليبي',
            'name_en' => 'Libyan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
