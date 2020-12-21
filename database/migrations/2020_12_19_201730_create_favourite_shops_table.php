<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouriteShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('favourite_id');
            $table->foreign('favourite_id')
            ->references('id')->on('favourites');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')
            ->references('id')->on('shops');
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
        Schema::dropIfExists('favourite_shops');
    }
}
