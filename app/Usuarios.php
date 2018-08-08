<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table ="usuarios";
    protected $primaryKey ="id_usuario";
    protected $fillable = [
        'id_usuario','nombre','correo','contrasena','telefono','condicion','id_roles'
    ];
    protected $hidden =[
    'contrasena','remember_token',
    ];
    public function Rol(){
        return $this->belongsTo('App\Roles');
    }

}
