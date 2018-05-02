<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
  protected $table = 'cupones';
  protected $fillable = ['descripcion', 'codigo', 'monto', 'usos', 'minimo', 'expiracion','user_id','maximo'];
  public function user(){
      return $this->belongsTo('App\User');
  }
  public function cuponeras(){
      return $this->hasMany('App\Cuponera');
  }
}
