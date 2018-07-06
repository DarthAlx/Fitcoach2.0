<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    protected $table = 'reservaciones';

	protected $fillable = ['horario_id', 'grupo_id', 'user_id','coach_id','nombre', 'tipo','fecha','hora', 'direccion', 'aforo', 'status','metadata','tokens'];

	public function user(){
		return $this->belongsTo('App\User');
	}
	public function horarios(){
		return $this->belongsTo('App\Horario');
	}
	public function rate(){
	   return $this->hasOne('App\Rating');
	 }
	 public function abono(){
	   return $this->hasOne('App\Abono');
	 }
	 public function grupo(){
		return $this->belongsTo('App\Grupo');
	}
}
