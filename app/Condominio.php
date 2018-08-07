<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{
  protected $table = 'condominios';
  protected $fillable = ['identificador', 'direccion', 'imagen'];
  public function residenciales(){
      return $this->hasMany('App\Grupo');
  }
  public function grupos(){
    return $this->hasMany('App\Grupo');
}
public function horarios(){
    return $this->hasMany('App\Horario');
}
}
