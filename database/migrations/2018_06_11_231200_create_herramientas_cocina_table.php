<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHerramientasCocinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('herramientas_cocina', function (Blueprint $table) {
            $table->increments('id_herramienta');
            $table->string('nombre');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->longtext('imagen');
            $table->boolean('condicion')->default(1);


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
        Schema::dropIfExists('herramientas_cocina');
    }
}
