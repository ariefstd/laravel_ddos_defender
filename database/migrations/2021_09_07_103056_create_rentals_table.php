<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('market_id');
            $table->string('rental_name', 150);
            $table->string('rental_slug', 150);
            $table->string('rental_address');
            $table->string('rental_cover');
            $table->string('rental_desc');
            $table->string('rental_phone', 12);
            $table->string('rental_wa', 12);
            $table->string('rental_price');
            $table->string('rental_posisi');
            $table->string('rental_size');
            $table->string('rental_iframe');
            $table->string('rental_gmap');
            $table->boolean('is_recommended')->default(0);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
            $table->blameable();
            $table->softDeletes();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('market_id')->references('id')->on('markets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}
