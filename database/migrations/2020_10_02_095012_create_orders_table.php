<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')->on('users');
            $table->unsignedBigInteger('meal_id');
            $table->foreign('meal_id')
            ->references('id')->on('meals');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')
            ->references('id')->on('shops');
            $table->unsignedInteger('quantity')->default(1);
            $table->string('billingAddress');
            $table->string('shippingAddress');
            $table->string('paymentType');
            $table->string('nameOnCard')->nullable();
            $table->string('cardNumber')->nullable();
            $table->time('cardExpiration')->nullable();
            $table->string('ccv')->nullable();
            $table->string('is_delivered')->default(false);
            $table->string('promo_code')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
