<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('auction_id')->unsigned()->nullable();
            $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('person_auction_id')->unsigned()->nullable();
            $table->foreign('person_auction_id')->references('id')->on('in_person_auctions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image')->nullable();   //
            $table->string('date')->nullable();
            $table->string('amount')->nullable();
            $table->boolean('is_accepted')->default(0);
            $table->enum('payment_type', ['cash','bank_deposit','online'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
