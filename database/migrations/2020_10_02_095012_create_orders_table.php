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
        Schema::enableForeignKeyConstraints();
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->unsignedBigInteger('meal_id');
            $table->foreign('meal_id')
                ->references('id')->on('meals');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')
                ->references('id')->on('shops');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedBigInteger('meal_size_id');
            $table->foreign('meal_size_id')
                ->references('id')->on('meal_sizes');
            $table->string('billing_address');
            $table->string('shipping_address');
            $table->enum('payment_type', ['bank-transfer', 'credit-card']);
            $table->text('order_status', ['delivery not started', 'delivery in progress', 'delivered'])->default('delivery not started');
            $table->string('card_type')->nullable();
            $table->string('name_on_card')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_expiration')->nullable();
            $table->string('ccv')->nullable();
            $table->boolean('is_delivered')->default(false);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('orders');
    }
}
