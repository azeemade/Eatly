<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('meal_name');
            $table->string('meal_slug');
            $table->string('meal_additional_text')->nullable();
            $table->enum('meal_status', ['in-stock', 'out-of-stock'])->default('in-stock')->nullable();
            $table->enum('meal_approval', ['active', 'awaiting', 'cancelled'])->default('awaiting');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('meals');
    }
}
