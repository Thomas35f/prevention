<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('address_line_1', 50)->nullable();
            $table->string('address_line_2', 50)->nullable();
            $table->string('zip_code', 5)->nullable();
            $table->string('town', 35)->nullable();
            $table->string('contact', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('companies');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
