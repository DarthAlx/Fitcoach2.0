<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
  protected $table = 'clases';
  protected $fillable = ['nombre', 'tipo', 'descripcion', 'imagen'];
  public function particulares(){
      return $this->hasMany('App\Particular');
  }
  public function residenciales(){
      return $this->hasMany('App\Residencial');
  }
}
