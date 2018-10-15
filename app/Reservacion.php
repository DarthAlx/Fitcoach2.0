<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model {
	protected $table = 'reservaciones';

	protected $fillable = [
		'horario_id',
		'grupo_id',
		'user_id',
		'coach_id',
		'nombre',
		'tipo',
		'fecha',
		'hora',
		'direccion',
		'aforo',
		'status',
		'metadata',
		'tokens',
		'comentarios'
	];

	public function user() {
		return $this->hasOne( 'App\User', 'id', 'user_id' );
	}

	public function horario() {
		return $this->belongsTo( 'App\Horario' );
	}

	public function rate() {
		return $this->hasOne( 'App\Rating' );
	}

	public function abono() {
		return $this->hasOne( 'App\Abono' );
	}

	public function grupo() {
		return $this->belongsTo( 'App\Grupo' );
	}

	public function plan() {
		return $this->hasOne( 'App\Plan' );
	}


	public function invitados() {
		return $this->hasMany( 'App\Invitado', 'reservacion_id', 'id' );
	}

	public function asistentes() {
		return $this->hasMany( 'App\ReservacionUsuario', 'reservacion_id', 'id' )->orderby('created_at','desc');
	}

}
