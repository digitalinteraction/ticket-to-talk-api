<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('birthYear');
            $table->string('birthPlace');
            $table->integer('admin_id')->unsigned();
            $table->integer('address_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('people', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign('person_areas_id_foreign');
        });
        
        Schema::drop('people');
    }
}
