<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('duration');
            $table->string('methods');
            $table->unsignedBigInteger('ingre_id');
            $table->foreign('ingre_id')->
            references('id')->on('ingredients');
            $table->string('region');
            $table->string('time');
            $table->string('image');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->
            references('id')->on('users');
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
        Schema::dropIfExists('recipes');
    }
}
