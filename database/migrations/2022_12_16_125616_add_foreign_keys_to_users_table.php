<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->name('client_id_user')->on('clients');
            $table->foreign('role_id')->references('id')->name('role_id_user')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
/*        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_client_id_foreign');
            $table->dropForeign('users_role_id_foreign');
        });*/
    }
};
