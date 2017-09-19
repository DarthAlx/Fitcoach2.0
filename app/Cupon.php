<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
  protected $table = 'cupones';
  protected $fillable = ['descripcion', 'codigo', 'monto', 'usos', 'minimo', 'expiracion'];
}
