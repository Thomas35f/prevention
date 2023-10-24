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
        Schema::table('trainings', function (Blueprint $table) {
            $table->foreign('offer_id')->references('id')->on('offers')->name('offer_id_training')->onDelete('CASCADE');
            $table->foreign('center_id')->references('id')->on('centers')->name('center_id_training')->onDelete('CASCADE');
            $table->foreign('trainer_id')->references('id')->on('trainers')->name('trainer_id_training')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
/*        Schema::table('trainings', function (Blueprint $table) {
            $table->dropForeign('trainings_offer_id_foreign');
            $table->dropForeign('trainings_center_id_foreign');
            $table->dropForeign('trainings_trainer_id_foreign');
        });
*/    }
};
