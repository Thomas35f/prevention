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
        Schema::create('trainer_subclient', function (Blueprint $table) {
            $table->uuid('subclient_id');
            $table->uuid('trainer_id');
            $table->primary(['subclient_id', 'trainer_id']);
            $table->foreign('subclient_id')->references('id')->on('subclients')->name('subclient_id_trainer_subclient')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('trainers')->name('tranier_id_trainer_subclient')->onDelete('cascade'); // assuming trainers are also users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainer_subclient');
    }
};
