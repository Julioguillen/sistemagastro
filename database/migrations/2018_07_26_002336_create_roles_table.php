<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id_rol');
            $table->string('nombre',30)->unique();
            $table->string('descripcion', 100 )->nullable;
            $table->boolean('condicion',30)->default(1);

            $table->timestamps();
        });
        DB::table('roles')->insert(array('id_rol'=>'1','nombre'=>'superAdministrador','descripcion'=>'Administrador de todo el area'));
        DB::table('roles')->insert(array('id_rol'=>'2','nombre'=>'Administrador','descripcion'=>'Administrador asignado'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
