<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danados extends Model
{
    protected $table ="danados";
    protected $primaryKey ="id_danados";
    protected $fillable = ['id_danados','nombre','cantidad','id_cristaleria'];
}
