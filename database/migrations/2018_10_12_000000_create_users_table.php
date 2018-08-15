<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id_usuario');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('telefono')->unique();
            $table->string('password');
            $table->text('imagen');
            $table->boolean('condicion')->default(1);

            $table->integer('id_roles')->unsigned();
            $table->foreign('id_roles')->references('id_rol')->on('roles');
            $table->rememberToken();
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
}
