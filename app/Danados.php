<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danados extends Model
{
    protected $table ="danados";
    protected $primaryKey ="id_danados";
    protected $fillable = ['id_danados','nombre','cantidad_danados','id_cristaleria'];

    public function Cantidad(){
        return $this->belongsTo('App\Herramientas_Cocina');
    }
}
