<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();         // Token
            $table->timestamps();            // Fecha de creación y edición
            $table->integer('id_user_type')->unsigned(); // Tipo de usuario int
            $table->integer('bloqueado');
            $table->integer('activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
