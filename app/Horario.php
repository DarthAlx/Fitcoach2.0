<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Horario extends Model {
	protected $table = 'horarios';

	protected $fillable = [
		'fecha',
		'hora',
		'user_id',
		'recurrencia',
		'zona_id',
		'clase_id',
		'condominio_id',
		'grupo_id',
		'room_id',
		'tipo',
		'audiencia',
		'cupo',
		'ocupados',
		'tokens',
		''
	];


	public function clase() {
		return $this->belongsTo( 'App\Clase' );
	}

	public function condominio() {
		return $this->belongsTo( 'App\Condominio' );
	}

	public function grupo() {
		return $this->belongsTo( 'App\Grupo' );
	}

	public function libres() {
		return $this->hasMany( 'App\Libres' );
	}

	public function reservaciones() {
		return $this->hasMany( 'App\Reservacion' )->orderby( 'created_at', 'desc' );
	}


	public function reservacion() {

		return Reservacion::where( 'horario_id', $this->attributes['id'] )
		                  ->orderby( 'created_at', 'desc' )
		                  ->get()
		                  ->first();
	}


	public function user() {
		return $this->belongsTo( 'App\User' );
	}

	public function zona() {
		return $this->belongsTo( 'App\Zona' );
	}


}
