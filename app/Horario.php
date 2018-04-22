<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';

	protected $fillable = ['fecha', 'hora', 'user_id', 'recurrencia','zona_id','clase_id', 'grupo_id'];

  	public function clase(){
       	return $this->belongsTo('App\Clase');
    }
	public function grupo(){
		return $this->belongsTo('App\Grupo');
	}
	public function libres(){
		return $this->hasMany('App\Libres');
	}
	public function reservaciones(){
		return $this->hasMany('App\Reservacion');
	}
}
