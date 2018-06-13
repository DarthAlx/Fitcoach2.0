<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';

	protected $fillable = ['fecha', 'hora','nombre', 'clase_id', 'user_id','tipo','condominio_id', 'audiencia', 'cupo', 'ocupados', 'evento_id','descripcion'];

  	public function clase(){
       	return $this->belongsTo('App\Clase');
    }
	public function condominio(){
		return $this->belongsTo('App\Condominio');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function evento(){
		return $this->belongsTo('App\Evento');
	}
	public function reservaciones(){
		return $this->hasMany('App\Reservacion');
	}
}
