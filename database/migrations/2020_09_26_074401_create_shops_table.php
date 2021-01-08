<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->unique();
            $table->string('shop_image');
            $table->string('shop_address');
            $table->string('shop_views')->nullable();
            $table->unsignedBigInteger('shop_vendor_id');
            $table->foreign('shop_vendor_id')
            ->references('id')->on('users');
            $table->string('shop_description');
            $table->time('open_time');
            $table->time('close_time');
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
        Schema::dropIfExists('shops');
    }
}
