<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
  protected $table = 'zonas';
  protected $fillable = ['identificador', 'descripcion','user_id'];
  public function user()
     {
       return $this->hasMany('App\User');
     }
     public function zona(){
         return $this->hasMany('App\Zonas_coaches');
     }
}
