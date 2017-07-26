<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
  protected $table = 'clases';
  protected $fillable = ['nombre', 'tipo', 'descripcion', 'imagen', 'precio', 'precio_especial'];
}
