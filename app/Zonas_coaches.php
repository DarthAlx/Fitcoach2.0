<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zonas_coaches extends Model
{
  protected $table = 'zonas_coaches';
  protected $fillable = ['user_id','zona_id'];
  public function zonas(){
      return $this->belongsTo('App\Zona');
  }
  public function coaches(){
      return $this->belongsTo('App\User');
  }
}
