<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe__ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingre_id');
            $table->foreign('ingre_id')->
            references('id')->on('ingredients');
            $table->unsignedBigInteger('recipe_id');
            $table->foreign('recipe_id')->
            references('id')->on('recipes');
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
        Schema::dropIfExists('recipe__ingredients');
    }
}
