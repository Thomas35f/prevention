<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('lastname',35)->nullable();
            $table->string('firstname',35)->nullable();
            $table->string('email',50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone',10)->nullable();
            $table->string('password', 60);
            $table->string('address', 100)->nullable();
            $table->char('zip_code', 5)->nullable();
            $table->string('town', 35)->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('role_id')->default(3);
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
        Schema::dropIfExists('users');
    }
};
