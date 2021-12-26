<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['buyer', 'seller'])->nullable();
            $table->enum('is_company', ['company','person'])->default('person'); // (مؤسسات , أفراد)
            $table->string('full_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('image')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('activation_code')->nullable();
            $table->string('address')->nullable();

//== for company
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('commercial_register_image')->nullable(); //السجل التجاري
//=========
            $table->boolean('is_accepted')->default(0);
            $table->boolean('is_appear_name')->default(0);
            $table->string('wallet')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->integer('city_id')->nullable();

            $table->softDeletes();
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
