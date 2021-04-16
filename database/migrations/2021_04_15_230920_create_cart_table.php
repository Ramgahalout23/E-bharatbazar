<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id')->length(10);
            $table->string('product_id')->length(11);
            $table->string('product_name')->length(50);
            $table->string('product_image')->length(50);
            $table->string('product_code')->length(112);
            $table->string('product_color')->length(255);
            $table->string('size')->length(255);
            $table->string('price')->length(255);
            $table->integer('quantity')->length(11);
            $table->string('user_email')->length(11);
            $table->string('session_id')->length(255);
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
        Schema::dropIfExists('cart');
    }
}
