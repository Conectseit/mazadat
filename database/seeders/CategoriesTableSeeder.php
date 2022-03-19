<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name_ar' => 'عقارات',
            'name_en' => 'buldings',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name_ar' => 'سيارات',
            'name_en' => 'cars',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name_ar' => 'مجوهرات',
            'name_en' => 'jewellery',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name_ar' => 'إكسيسوارات',
            'name_en' => 'accessories',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name_ar' => 'ارقام هاتف',
            'name_en' => 'mobile Numbers',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name_ar' => 'ارقام سيارات',
            'name_en' => 'car plates',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name_ar' => 'اعمال فنيه مميزه',
            'name_en' => 'masterpieces',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name_ar' => 'مقتنيات نادره',
            'name_en' => 'rare elements',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
