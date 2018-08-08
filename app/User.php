<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table ="users";
    protected $primaryKey ="id_usuario";
    protected $fillable = [
        'id_usuario','name','email','password','telefono','condicion','id_roles'
    ];
    protected $hidden =[
        'password','remember_token',
    ];
    public function Rol(){
        return $this->belongsTo('App\Roles');
    }
}
