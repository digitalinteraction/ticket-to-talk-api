<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserIdOnConsents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consents', function (Blueprint $table) {
            $table->dropForeign('consents_userid_foreign');
        });

        Schema::table('consents', function (Blueprint $table) {
            $table->renameColumn('userID', 'user_id');
        });

        Schema::table('consents', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consents', function (Blueprint $table) {
            $table->dropForeign('consents_user_id_foreign');
        });

        Schema::table('consents', function (Blueprint $table) {
            $table->renameColumn('user_id', 'userID');
        });

        Schema::table('consents', function (Blueprint $table) {
            $table->foreign('userID')->references('id')->on('users');
        });
    }
}
