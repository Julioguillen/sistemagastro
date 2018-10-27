<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDanadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danados', function (Blueprint $table) {
            $table->increments('id_danados');
            $table->string('nombre');
            $table->integer('cantidad_danados');
            $table->string('descripcion_danados');
            $table->integer('control');
            $table->string('alumno');
            $table->longtext('imagen');
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
        Schema::dropIfExists('danados');
    }
}
