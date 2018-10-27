<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table ="equipos";
    protected $primaryKey ="id_equipo";
    protected $fillable = ['id_equipo','nombre','cantidad','descripcion','imagen'];
}
