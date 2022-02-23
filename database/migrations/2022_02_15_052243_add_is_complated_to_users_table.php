<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsComplatedToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('ban')->default(0)->after('password');
            $table->boolean('unique_company')->default(0)->after('ban');
            $table->string('company_authorization_image')->after('commercial_register_image')->nullable();
            $table->boolean('is_completed')->default(0)->after('city_id');
            $table->string('block')->after('is_completed')->nullable(); // الحي
            $table->string('street')->after('block')->nullable();
            $table->string('block_num')->after('street')->nullable();
            $table->string('signs')->after('block_num')->nullable();
            $table->enum('delivery_time',['am','pm'])->after('block_num');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ban');
            $table->dropColumn('unique_company');
            $table->dropColumn('company_authorization_image');
            $table->dropColumn('is_completed');
            $table->dropColumn('block');
            $table->dropColumn('street');
            $table->dropColumn('block_num');
            $table->dropColumn('signs');
            $table->dropColumn('delivery_time');

        });
    }
}
