<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTicketLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_logs', function (Blueprint $table) {
            $table->integer('conversation_log_id')->unsigned();
            $table->foreign('conversation_log_id')->references('id')->on('conversation_logs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_logs', function (Blueprint $table) {
            $table->dropForeign('conversation_logs_ticket_logs_conversation_log_id_foreign');
            $table->dropColumn('conversation_log_id');
        });
    }
}
