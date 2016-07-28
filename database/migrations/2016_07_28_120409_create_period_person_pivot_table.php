<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodPersonPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period_person', function (Blueprint $table) {
            $table->integer('period_id')->unsigned()->index();
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
            $table->integer('person_id')->unsigned()->index();
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->primary(['period_id', 'person_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('period_person');
    }
}
