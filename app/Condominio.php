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
}
