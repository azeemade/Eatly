<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Schema::enableForeignKeyConstraints();
        Schema::create('cart_meals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->foreign('cart_id')
            ->references('id')->on('carts');
            $table->unsignedBigInteger('meal_id');
            $table->foreign('meal_id')
            ->references('id')->on('meals');
            $table->unsignedBigInteger('meal_size_id');
            $table->foreign('meal_size_id')
            ->references('id')->on('meal_sizes');
            $table->unsignedInteger('quantity')->default(1);
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
      //  Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('cart_meals');
    }
}
