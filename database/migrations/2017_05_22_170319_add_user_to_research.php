<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToResearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->boolean("in_study");
        });

        Schema::table('ticket_logs', function (Blueprint $table) {
            $table->integer("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('conversation_logs', function (Blueprint $table) {
            $table->integer("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("in_study");
        });

        Schema::table('ticket_logs', function (Blueprint $table) {
            $table->dropForeign(["user_id"]);
            $table->dropColumn("user_id");
        });

        Schema::table('conversation_logs', function (Blueprint $table) {
            $table->dropForeign(["user_id"]);
            $table->dropColumn("user_id");
        });
    }
}
