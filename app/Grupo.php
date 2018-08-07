<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';

	protected $fillable = ['nombre','condominio_id','room_id','descripcion'];

  	
	public function condominio(){
		return $this->belongsTo('App\Condominio');
	}
	public function horarios(){
		return $this->hasMany('App\Horario');
	}
	public function room(){
		return $this->belongsTo('App\Room');
	}
	
}
