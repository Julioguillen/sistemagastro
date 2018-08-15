<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cristaleria extends Model
{
    protected $table ="cristaleria";
    protected $primaryKey ="id_cristaleria";
    protected $fillable = ['id_cristaleria','nombre','cantidad','condicion'];
}
