<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->increments('id')->length(12);
            $table->integer('order_id')->length(10);
            $table->integer('user_id')->length(11);
            $table->integer('product_id')->length(11);
            $table->string('product_code')->length(255);
            $table->string('product_name')->length(255);
            $table->string('product_color')->length(255);
            $table->string('product_size')->length(255);
            $table->integer('product_price')->length(50);
            $table->integer('product_qty')->length(50);
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
        Schema::dropIfExists('orders_products');
    }
}
