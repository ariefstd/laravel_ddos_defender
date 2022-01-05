<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerPromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_promos', function (Blueprint $table) {
            $table->id();
            $table->string('banner_name', 60);
            $table->string('banner_slug')->unique();
            $table->integer('banner_seq');
            $table->string('banner_image');
            $table->string('banner_link');
            $table->boolean('is_active')->default(0);
            $table->timestamps();
            $table->blameable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_promos');
    }
}
