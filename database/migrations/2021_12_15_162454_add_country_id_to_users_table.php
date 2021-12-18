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
            $table->enum('allowed_email_messages', ['allow', 'not_allow'])->default('allow')->after('country_id');
            $table->enum('allowed_mobile_messages', ['allow', 'not_allow'])->default('allow')->after('allowed_email_messages');
            $table->enum('preferred_language', ['arabic', 'english'])->default('arabic')->after('allowed_mobile_messages');
            $table->enum('accept_app_terms', ['yes','no'])->default('no')->after('preferred_language');
            $table->string('P_O_Box')->nullable()->after('accept_app_terms');

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
            $table->dropColumn('allowed_email_messages');
            $table->dropColumn('allowed_mobile_messages');
            $table->dropColumn('preferred_language');
            $table->dropColumn('accept_app_terms');
            $table->dropColumn('P.O.Box');
        });
    }
}
