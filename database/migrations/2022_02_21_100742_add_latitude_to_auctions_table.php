<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatitudeToAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->string('latitude')->nullable()->after('current_price');
            $table->string('longitude')->nullable()->after('latitude');
            $table->boolean('allowed_take_photo')->default(0)->after('longitude');
            $table->boolean('is_unique')->default(0)->after('current_price');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('allowed_take_photo');
            $table->dropColumn('is_unique');


        });
    }
}
