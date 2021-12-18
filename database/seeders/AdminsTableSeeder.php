<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admin_roles')->insert([
            'id' => 1,
            'name_ar' => 'مدير عام',
            'name_en' => 'Super Dashboard',
            'permissions' => '*',
            'description_ar' => '',
            'description_en' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('admins')->insert([
            'id' => 1,
            'full_name' => 'Mona Elshenawey',
            'email' => 'admin@admin.com',
            'is_super_admin' => 1,
            'password' => bcrypt('123456'),
            'mobile' => '123456789',
            'admin_role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
