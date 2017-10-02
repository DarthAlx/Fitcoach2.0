<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
  protected $table = 'particulares';
  protected $fillable = ['fecha', 'hora','user_id', 'clase_id', 'recurrencia', 'zona_id'];
  public function user(){
    return $this->belongsTo('App\User');
  }
  public function clase(){
    return $this->belongsTo('App\Clase');
  }
  public function zona(){
    return $this->belongsTo('App\Zona');
  }
}
