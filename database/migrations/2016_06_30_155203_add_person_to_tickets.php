<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonToTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->integer('person_id')->unsigned()->nullable();
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign("tickets_person_id_foreign");
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('person_id');
        });
    }
}
