<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table ="usuarios";
    protected $primaryKey ="id_usuario";
    protected $fillable = ['id_usuario','nombre','correo','contrasena','telefono'];
}
