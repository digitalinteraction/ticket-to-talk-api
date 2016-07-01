<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToPerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('person', function (Blueprint $table) {
//            $table->renameColumn('addressID', 'address_id');
//        });

        Schema::table('person', function (Blueprint $table) {
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
        Schema::table('person', function (Blueprint $table) {
            $table->dropForeign('person_areas_id_foreign');
        });

//        Schema::table('person', function (Blueprint $table) {
//            $table->renameColumn('address_id', 'addressID');
//        });
    }
}
