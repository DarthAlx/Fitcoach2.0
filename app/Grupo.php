<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';

	protected $fillable = ['nombre', 'clase_id', 'user_id', 'precio','tipo','condominio_id', 'audiencia', 'cupo', 'ocupados', 'evento_id'];

  	public function clase(){
       	return $this->belongsTo('App\Clase');
    }
	public function condominio(){
		return $this->belongsTo('App\Condominio');
	}
	public function coach(){
		return $this->belongsTo('App\User');
	}
	public function evento(){
		return $this->belongsTo('App\Evento');
	}

	public function horarios(){
		return $this->hasMany('App\Horario');
	}
	public function reservaciones(){
		return $this->hasMany('App\Reservacion');
	}
}
