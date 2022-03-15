<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seller_id')->unsigned()->nullable();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('buyer_id')->unsigned()->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->enum('status', ['on_progress', 'done','not_accepted'])->default('on_progress');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('is_accepted')->default(0); // when user not admin  will add auction later //
            $table->enum('who_can_see',['all','person','company'])->default('all'); // خيار مشاهدة المزاد
            $table->enum('who_can_buy',['all','person','company'])->default('all'); //خيار المزايدة في المزاد
            $table->integer('count_of_buyer')->default(0);  //عدد المزايدين
            $table->string('value_of_increment')->nullable(); //قيمة المزايدة في كل مرة
            $table->integer('start_auction_price')->default(0);  //القيمة الابتدائية للمزاد
            $table->integer('current_price')->default(0);

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
        Schema::dropIfExists('auctions');
    }
}
