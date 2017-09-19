<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuponera extends Model
{
  protected $table = 'cuponera';
  protected $fillable = ['cupon_id', 'user_id', 'orden_id'];
  public function cupon(){
      return $this->hasOne('App\Cupon');
  }
  public function user(){
      return $this->hasOne('App\User');
  }
  public function orden(){
      return $this->hasOne('App\Orden');
  }
}
