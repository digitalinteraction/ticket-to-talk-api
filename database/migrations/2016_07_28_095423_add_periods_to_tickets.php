<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPeriodsToTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->integer("period_id")->unsigned()->nullable();
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
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
            $table->dropColumn("period_id");
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign("tickets_period_id_foreign");
        });
    }
}
