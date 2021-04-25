<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address')->length(255)->nullable();
            $table->string('state')->length(100)->nullable();
            $table->string('city')->length(100)->nullable();
            $table->string('country')->length(100)->nullable();
            $table->string('pincode')->length(100)->nullable();
            $table->string('mobile')->length(100)->nullable();
            $table->tinyInteger('admin')->length(255)->default(0);
            $table->tinyInteger('status')->length(4)->default(0);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
