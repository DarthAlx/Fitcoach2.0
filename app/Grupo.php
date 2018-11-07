<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
		return collect(DB::select( DB::raw( "SELECT AVG(ocupados) as promedio FROM horarios INNER JOIN reservaciones ON (horarios.id=reservaciones.horario_id) WHERE horarios.grupo_id =:grupo_id AND reservaciones.status='COMPLETA';" ), [
			'grupo_id' => $this->attributes['id']
		] ))->first();
	}

}
