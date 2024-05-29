<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->text('district_ar');
            $table->text('district_en');
            $table->text('street_ar');
            $table->text('street_en');
            $table->text('property_facade_ar');
            $table->text('property_facade_en');
            $table->integer('space');
            $table->enum('purpose', ['residential','commercial'])->default('residential');
            $table->integer('price_per_meter_of_land');
            $table->integer('unit_price');
            $table->text('property_type_ar');
            $table->text('property_type_en');
            $table->integer('age_of_the_property');
            $table->text('services_related_ar');
            $table->text('services_related_en');
            $table->enum('purpose_of_the_advertisement' ,['sale','rent'])->default('sale');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('products');
    }
}
