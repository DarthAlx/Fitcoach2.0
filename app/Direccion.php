<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
  protected $table = 'direcciones';
  protected $fillable = ['identificador', 'calle','numero_ext','numero_int', 'colonia', 'municipio_del', 'cp','estado','user_id'];
  public function user()
     {
       return $this->belongsTo('App\User');
     }
}
