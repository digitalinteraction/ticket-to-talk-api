<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userID')->unsigned()->nullable();
            $table->boolean('core');
            $table->boolean('subscribed');
            $table->boolean('research');
            $table->boolean('googleAnalytics');
            $table->timestamps();
        });

        Schema::table('consents', function (Blueprint $table) {
            $table->foreign('userID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consents'. function (Blueprint $table) {
            $table->dropForeign('consents_users_id_foreign');
        });

        Schema::drop('consents');
    }
}
