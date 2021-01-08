<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Schema::enableForeignKeyConstraints();
        Schema::create('meal_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('meal_size');
            $table->string('meal_id');
            $table->decimal('meal_price', 8, 2);
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
       // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('meal_sizes');
    }
}
