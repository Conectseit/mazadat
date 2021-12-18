<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_role_id')->nullable()->unsigned();
            $table->foreign('admin_role_id')->references('id')->on('admin_roles')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('full_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('is_super_admin')->default(0);
            $table->string('password')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');

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
        Schema::dropIfExists('admins');
    }
}
