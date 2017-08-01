<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
  protected $table = 'zonas';
  protected $fillable = ['identificador', 'descripcion','user_id'];
  public function user()
     {
       return $this->belongsTo('App\User');
     }
}
