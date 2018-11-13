<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Grupo extends Model {

	use SoftDeletes;

	protected $table = 'grupos';

	protected $fillable = [
		'nombre',
		'condominio_id',
		'room_id',
		'descripcion',
		'user_id',
		'clase_id',
		'audiencia',
		'cupo',
		'tokens'
	];

	public function condominio() {
		return $this->belongsTo( 'App\Condominio' );
	}

	public function horarios() {
		return $this->hasMany( 'App\Horario' );
	}

	public function room() {
		return $this->belongsTo( 'App\Room' );
	}

	public function coach() {
		return $this->hasOne( 'App\User', 'id', 'user_id' );
	}

	public function clase() {
		return $this->belongsTo( 'App\Clase' );
	}

	public function aforoPromedio() {

		$horarios      = Horario::where( 'grupo_id', $this->attributes['id'] )->get();
		$horarioIds    = collect( $horarios )->pluck( 'id' );
		$reservaciones = Reservacion::whereIn( 'horario_id', $horarioIds )
		                            ->where( function ( $query ) {
			                            $query->where( 'status', 'COMPLETA' );
			                            $query->orWhere( 'status', 'EN REVISIÓN' );
		                            } )->get();
		$count = count( $reservaciones );
		Log::debug( "this is ths reservations", [ "count" => $count ] );
		$total = 0;
		foreach ( $reservaciones as $reservacion ) {
			$data      = collect( DB::select( DB::raw( "SELECT COUNT(*) as aforo FROM reservacion_usuarios WHERE reservacion_usuarios.asistencia = 1 AND reservacion_usuarios.reservacion_id =:reservacion_id;" ), [
				'reservacion_id' => $reservacion->id
			] ) )->first()->aforo;
			$invitados = Invitado::where( 'reservacion_id', $reservacion->id )->get()->count();
			$total     = $data + $invitados;
		}
		if ( $count > 0 ) {
			return $total / $count;
		} else {
			return 0;
		}
	}

}
