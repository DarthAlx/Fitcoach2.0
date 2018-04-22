<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libres extends Model
{
    protected $table = 'libres';

	protected $fillable = ['horario_id', 'fecha', 'hora', 'user_id'];

  	public function horario(){
       	return $this->belongsTo('App\Horario');
    }
}
