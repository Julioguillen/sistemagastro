<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mueble extends Model
{
    protected $table ="mueble";
    protected $primaryKey ="id_mueble";
    protected $fillable = ['id_mueble','nombre','cantidad','condicion'];
}
