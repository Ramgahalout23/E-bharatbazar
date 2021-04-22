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
            $table->increments('id')->length(10);
            $table->integer('user_id')->length(10);
            $table->string('user_email')->length(100);
            $table->string('name')->length(100);
            $table->string('address')->length(250);
            $table->string('city')->length(100);
            $table->string('state')->length(100);
            $table->integer('pincode')->length(50);
            $table->string('country')->length(250);
            $table->string('mobile')->length(50);
            $table->string('shipping_charges')->length(50)->default('0');
            $table->string('coupon_code')->length(50);
            $table->string('coupon_amount')->length(50);
            $table->string('order_status')->length(50);
            $table->string('payment_method')->length(50);
            $table->string('grand_total')->length(50);
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
