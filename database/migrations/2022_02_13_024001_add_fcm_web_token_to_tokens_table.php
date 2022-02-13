<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFcmWebTokenToTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tokens', function (Blueprint $table) {
          $table->string('fcm_web_token')->after('fcm')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tokens', function (Blueprint $table) {
            $table->dropColumn('fcm_web_token');
        });
    }
}
