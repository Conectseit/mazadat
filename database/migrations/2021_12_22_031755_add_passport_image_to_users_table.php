<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPassportImageToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('wallet')->default(0)->after('is_appear_name');
            $table->integer('available_limit')->default(0)->after('wallet');
            $table->string('passport_expiry_date')->nullable()->after('available_limit');
            $table->string('passport_image')->nullable()->after('passport_expiry_date');
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
            $table->dropColumn('wallet');
            $table->dropColumn('available_limit');
            $table->dropColumn('passport_expiry_date');
            $table->dropColumn('passport_image');
        });
    }
}
