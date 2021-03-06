<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table ="roles";
    protected $primaryKey ="id_rol";
    protected $fillable = ['id_rol','nombre','descripcion','condicion'];

    public function usuarios(){
        return $this->hasMany('App\Usuarios');
    }
}
