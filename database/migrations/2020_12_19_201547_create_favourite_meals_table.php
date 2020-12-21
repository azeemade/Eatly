<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouriteMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_meals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('favourite_id');
            $table->foreign('favourite_id')
            ->references('id')->on('favourites');
            $table->unsignedBigInteger('meal_id');
            $table->foreign('meal_id')
            ->references('id')->on('meals');
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
        Schema::dropIfExists('favourite_meals');
    }
}
