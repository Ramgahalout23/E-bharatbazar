<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id')->length(10);
            $table->string('name')->length(255);
            $table->string('text_style')->length(255);
            $table->integer('sort_order')->length(10);
            $table->string('content')->length(255);
            $table->string('link')->length(255);
            $table->tinyInteger('status')->length(4)->default('1');
            $table->string('image')->length(255);
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
        Schema::dropIfExists('banners');
    }
}
