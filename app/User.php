<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract,
	AuthorizableContract,
	CanResetPasswordContract {
	use Authenticatable, Authorizable, CanResetPassword;


	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'role',
		'dob',
		'tel',
		'genero',
		'rating',
		'acceso',
		'code',
		'referencia',
		'editor',
		'condominio_id'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [ 'password', 'remember_token' ];

	public function detalles() {
		return $this->hasOne( 'App\Detalle' );
	}

	public function direcciones() {
		return $this->hasMany( 'App\Direccion' );
	}

	public function tarjetas() {
		return $this->hasMany( 'App\Tarjeta' );
	}

	public function horarios() {
		return $this->hasMany( 'App\Horario' );
	}

	public function residenciales() {
		return $this->hasMany( 'App\Horario' );
	}

	public function ordenes() {
		return $this->hasMany( 'App\Orden' );
	}

	public function bancarios() {
		return $this->hasOne( 'App\Bancarios' );
	}

	public function pagos() {
		return $this->hasMany( 'App\Pago' );
	}

	public function rate() {
		return $this->hasMany( 'App\Rating' );
	}

	public function abonos() {
		return $this->hasMany( 'App\Abono' );
	}

	public function cupon() {
		return $this->hasOne( 'App\Cupon' );
	}

	public function paquetes() {
		return $this->hasMany( 'App\PaqueteComprado' );
	}

	public function reservaciones() {
		return $this->hasMany( 'App\Reservacion' );
	}

	public function grupo() {
		return $this->hasMany( 'App\Grupo' );
	}

	public function libres() {
		return $this->hasMany( 'App\Libres' );
	}

	public function documentacion() {
		return $this->hasOne( 'App\Documentacion' );
	}

	public function paquetesDisponiblesDomicilio() {
		$now = Carbon::now();

		return PaqueteComprado::where( 'user_id', $this->attributes['id'] )
		                      ->where( 'expiracion', '>', $now->toDateString() )
		                      ->where( 'tipo', 'A domicilio' )
		                      ->where( 'disponibles', '>', '0' )
		                      ->sum( 'disponibles' );
	}

	public function paquetesDisponiblesCondominio() {
		$now = Carbon::now();

		return PaqueteComprado::where( 'user_id', $this->attributes['id'] )
		                      ->where( 'expiracion', '>', $now->toDateString() )
		                      ->where( 'tipo', 'En condominio' )
		                      ->where( 'disponibles', '>', '0' )
		                      ->sum( 'disponibles' );
	}

	public function paquetesUsadosDomicilio() {
		$now = Carbon::now();

		return PaqueteComprado::where( 'user_id', $this->attributes['id'] )
		                      ->where( 'expiracion', '>', $now->toDateString() )
		                      ->where( 'tipo', 'A domicilio' )
		                      ->where( 'disponibles', '=', '0' )
		                      ->count( 'id' );
	}

	public function paquetesporVencerDomicilio() {
		$now = Carbon::now();

		return PaqueteComprado::where( 'user_id', $this->attributes['id'] )
		                      ->where( 'expiracion', '>', $now->toDateString() )
		                      ->where( 'tipo', 'A domicilio' )
		                      ->sum( 'disponibles' );
	}

	public function paquetesVencidosDomicilio() {
		$now = Carbon::now();

		return PaqueteComprado::where( 'user_id', $this->attributes['id'] )
		                      ->where( 'expiracion', '<', $now->toDateString() )
		                      ->where( 'tipo', 'A domicilio' )
		                      ->sum( 'disponibles' );
	}

	public function paquetesUsadosCondominio() {
		$now = Carbon::now();

		return PaqueteComprado::where( 'user_id', $this->attributes['id'] )
		                      ->where( 'expiracion', '>', $now->toDateString() )
		                      ->where( 'tipo', 'En condominio' )
		                      ->where( 'disponibles', '=', '0' )
		                      ->count( 'id' );
	}

	public function paquetesporVencerCondominio() {
		$now = Carbon::now();

		return PaqueteComprado::where( 'user_id', $this->attributes['id'] )
		                      ->where( 'expiracion', '>', $now->toDateString() )
		                      ->where( 'tipo', 'En condominio' )
		                      ->sum( 'disponibles' );
	}

	public function paquetesVencidosCondominio() {
		$now = Carbon::now();

		return PaqueteComprado::where( 'user_id', $this->attributes['id'] )
		                      ->where( 'expiracion', '<', $now->toDateString() )
		                      ->where( 'tipo', 'En condominio' )
		                      ->sum( 'disponibles' );
	}

	public function condominioAdmin() {
		return $this->hasOne( 'App\Condominio', 'id', 'condominio_id' );
	}


}
