<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsVerifiedToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('address2');
            $table->dropColumn('passport_expiry_date');
            $table->dropColumn('gender');
            $table->dropColumn('preferred_language');
            $table->dropColumn('bio');
            $table->string('person_latitude')->nullable()->after('P_O_Box');
            $table->string('person_longitude')->nullable()->after('person_latitude');
            $table->boolean('is_verified')->default(0)->after('ban');

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
            $table->string('address');
            $table->string('address2');
            $table->string('passport_expiry_date');
            $table->string('gender');
            $table->string('preferred_language');
            $table->string('bio');
            $table->dropColumn('is_verified');
            $table->dropColumn('person_latitude');
            $table->dropColumn('person_longitude');
        });
    }
}
