<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('shop_id');
            $table->string('shop_name');
            $table->string('url');
            $table->string('session_id');
            $table->unsignedInteger('user_id');
            $table->string('ip');
            $table->string('agent');
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
        Schema::dropIfExists('shop_views');
    }
}
