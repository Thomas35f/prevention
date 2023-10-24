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
        Schema::create('criterion_theme', function (Blueprint $table) {
            $table->unsignedBigInteger('criterion_id');
            $table->unsignedBigInteger('theme_id');

            $table->primary(['criterion_id', 'theme_id']);

            $table->foreign('criterion_id')->references('id')->on('criteria')->name('criterion_id_criterion_theme')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes')->name('theme_id_criterion_theme')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
/*        Schema::table('criterion_theme', function (Blueprint $table) {
            $table->dropForeign(['criterion_id']);
            $table->dropForeign(['theme_id']);
        });
*/
        Schema::dropIfExists('criterion_theme');
    }
};
