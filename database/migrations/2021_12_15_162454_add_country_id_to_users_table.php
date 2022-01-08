<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('nationality_id')->unsigned()->after('gender')->nullable();
            $table->foreign('nationality_id')->references('id')->on('nationalities')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('country_id')->after('nationality_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('city_id')->after('country_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('preferred_language', ['arabic', 'english'])->default('arabic')->after('city_id');
            $table->enum('accept_app_terms', ['yes','no'])->default('no')->after('preferred_language');
            $table->string('P_O_Box')->nullable()->after('accept_app_terms');
            $table->string('bio')->nullable()->after('P_O_Box');
            $table->enum('is_active', ['deactive','active'])->default('deactive')->after('activation_code');
            $table->string('reset_password_code')->nullable()->after('is_active');




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
            $table->dropColumn('nationality_id');
            $table->dropColumn('country_id');
            $table->dropColumn('city_id');
//            $table->dropColumn('allowed_mobile_messages');
            $table->dropColumn('preferred_language');
            $table->dropColumn('accept_app_terms');
            $table->dropColumn('P_O_Box');
            $table->dropColumn('bio');
            $table->dropColumn('is_active');
            $table->dropColumn('reset_password_code');
        });
    }
}
