<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLimitedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limiteds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip')->nullable();
            $table->string('api_key')->nullable();
            $table->string('method');
            $table->string('user_agent')->nullable();
            $table->string('path');
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
        Schema::drop('limiteds');
    }
}
