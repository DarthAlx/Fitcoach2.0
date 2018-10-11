<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservacionUsuario extends Model {

	protected $table = 'reservacion_usuarios';
	protected $fillable = [ 'reservacion_id', 'usuario_id', 'asistencia' ];

	public function usuario()
	{
		return $this->hasOne('App\User','id','usuario_id');
	}

	public function reservacion()
	{
		return $this->hasOne('App\Reservacion','id','reservacion_id');
	}

}
