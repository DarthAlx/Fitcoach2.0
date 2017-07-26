<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residencial extends Model
{
  protected $table = 'residenciales';
  protected $fillable = ['fecha', 'hora','user_id', 'condominio_id', 'clase_id','precio', 'audiencia', 'cupo', 'tipo', 'descripcion'];
  public function user(){
    return $this->belongsTo('App\User');
  }
  public function condominio(){
    return $this->belongsTo('App\Condominio');
  }
  public function clase(){
    return $this->belongsTo('App\Clase');
  }
}
