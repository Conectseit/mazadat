<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPassportToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('limit')->nullable()->after('wallet');
            $table->string('passport')->nullable()->after('limit');
            $table->string('passport_image')->nullable()->after('passport');

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
            $table->dropColumn('limit');
            $table->dropColumn('passport');
            $table->dropColumn('passport_image');

        });
    }
}
