<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSerialNumberToAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->string('serial_number')->nullable()->after('start_auction_price');
            $table->text('auction_terms_ar')->nullable()->after('serial_number');
            $table->text('auction_terms_en')->nullable()->after('auction_terms_ar');
            $table->string('delivery_charge')->nullable()->after('auction_terms_en');
//            $table->string('inspection_report_image')->nullable()->after('delivery_charge');
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
            $table->dropColumn('serial_number');
            $table->dropColumn('auction_terms_ar');
            $table->dropColumn('auction_terms_en');
            $table->dropColumn('delivery_charge');
//            $table->dropColumn('inspection_report_image');

        });
    }
}
