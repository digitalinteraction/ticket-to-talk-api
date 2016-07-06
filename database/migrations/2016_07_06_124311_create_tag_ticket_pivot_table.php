<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTicketPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned()->nullable();
            $table->integer('ticket_id')->unsigned()->nullable();
        });

        Schema::table('ticket_tag', function(Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_tag', function(Blueprint $table) {
            $table->dropForeign("ticket_tag_tag_id_foreign");
            $table->dropForeign("ticket_tag_ticket_id_foreign");
        });

        Schema::drop('ticket_tag');
    }
}
