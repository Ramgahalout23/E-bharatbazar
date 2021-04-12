<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->length(10);
            $table->integer('category_id')->length(10);
            $table->string('name')->length(255);
            $table->string('code')->length(255);
            $table->string('color')->length(255);
            $table->text('description')->length(255);
            $table->string('price')->length(20);
            $table->string('image')->length(255);
            $table->tinyInteger('status')->length(10)->default('1');
            $table->tinyInteger('featured_products')->length(4)->default('1');
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
        Schema::dropIfExists('products');
    }
}
