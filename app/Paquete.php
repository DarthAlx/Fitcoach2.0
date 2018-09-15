<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = 'paquetes';

  protected $fillable = ['paquete', 'precio','precio_clase', 'num_clases', 'dias', 'tipo'];

}
