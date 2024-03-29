<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('promo_code');
            $table->string('promo_status')->default('active');
            $table->string('promo_amount');
            $table->date('initial_active_date')->nullable();
            $table->date('final_active_date')->nullable();
            $table->string('no_of_users')->nullable();
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')
            ->references('id')->on('shops');
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
        Schema::dropIfExists('promos');
    }
}
