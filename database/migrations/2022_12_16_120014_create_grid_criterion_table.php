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
        Schema::create('grid_criterion', function (Blueprint $table) {
            $table->unsignedBigInteger('criterion_id');
            $table->uuid('grid_id');

            $table->primary(['criterion_id', 'grid_id']);

            $table->foreign('criterion_id')->references('id')->on('criteria')->name('criterion_id_criterion_grid')->onDelete('cascade');
            $table->foreign('grid_id')->references('id')->on('grids')->name('grid_id_criterion_grid')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
/*        Schema::table('grid_criterion', function (Blueprint $table) {
            $table->dropForeign(['criterion_id_criterion_grid']);
            $table->dropForeign(['grid_id_criterion_grid']);
        });
*/
        Schema::dropIfExists('grid_criterion');
    }
};
