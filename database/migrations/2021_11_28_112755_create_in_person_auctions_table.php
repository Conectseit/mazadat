<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInPersonAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_person_auctions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seller_id')->unsigned()->nullable();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('buyer_id')->unsigned()->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
//            $table->enum('category',['real_estate','cars'])->default('real_estate');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('name_of_the_licensor')->nullable();
            $table->integer('license_number')->nullable();
            $table->integer('brokerage_license_number')->nullable();
            $table->enum('status', ['on_progress', 'done','not_accepted','deleted'])->default('on_progress');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('is_accepted')->default(0); // when user not admin  will add auction later //
            $table->boolean('is_appear')->default(0);
            $table->boolean('is_appear_location')->default(0);
            $table->enum('who_can_see',['all','person','company'])->default('all'); // خيار مشاهدة المزاد
            $table->enum('who_can_buy',['all','person','company'])->default('all'); //خيار المزايدة في المزاد
            $table->integer('count_of_buyer')->default(0);  //عدد المزايدين
            $table->string('value_of_increment')->nullable(); //قيمة المزايدة في كل مرة
            $table->integer('start_auction_price')->default(0);  //القيمة الابتدائية للمزاد
            $table->string('serial_number')->nullable();
            $table->text('auction_terms_ar')->nullable();
            $table->text('auction_terms_en')->nullable();
            $table->string('delivery_charge')->nullable();
            $table->integer('current_price')->default(0);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('allowed_take_photo')->default(0);
            $table->boolean('is_unique')->default(0);
            $table->string('address')->nullable();
            $table->string('extra')->nullable();
            $table->text('district_ar')->nullable();
            $table->text('district_en')->nullable();
            $table->text('street_ar')->nullable();
            $table->text('street_en')->nullable();
            $table->text('property_facade_ar')->nullable();
            $table->text('property_facade_en')->nullable();
            $table->integer('space')->nullable();
            $table->enum('purpose', ['residential','commercial'])->default('residential');
            $table->integer('price_per_meter_of_land')->nullable();
            $table->integer('unit_price')->nullable();
            $table->text('property_type_ar')->nullable();
            $table->text('property_type_en')->nullable();
            $table->integer('age_of_the_property')->nullable();
            $table->text('services_related_ar')->nullable();
            $table->text('services_related_en')->nullable();
            $table->enum('purpose_of_the_advertisement' ,['sale','rent'])->default('sale');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('in_person_auctions');
    }
}
