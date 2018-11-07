<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 11/09/18
 * Time: 06:23 PM
 */

namespace App\Http\Controllers\Instructor;


use App\Clase;
use App\ReservacionUsuario;
use App\Direccion;
use App\Horario;
use App\Http\Controllers\Controller;
use App\Invitado;
use App\Plan;
use App\Repositories\ClaseRepository;
use App\Reservacion;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PerfilInstructor extends Controller {
	public function index() {
		$repository = new ClaseRepository();

		$user     = User::find( Auth::user()->id );
		$data     = $repository->clasesDeCoach( Auth::user()->id );
		$pasadas  = $repository->clasesPasadas( Auth::user()->id );
		$array    = array();
		$proximas = array();
		$now      = Carbon::now();
		foreach ( $data as $item ) {
			date_default_timezone_set( 'America/Mexico_City' );
			if ( $item->tipo == "clase" ) {
				$horario     = Horario::with( 'condominio' )->where( 'id', '=', $item->horarioId )->get()->first();
				$item->lugar = $horario->condominio->direccion;
			} else {
				$reservacion   = Reservacion::where( 'id', '=', $item->reservacionId )->get()->first();
				$cliente       = User::with( 'detalles' )->find( $reservacion->user_id );
				$direccion     = Direccion::find( $reservacion->direccion );
				$item->lugar   = $direccion->calle . " " .
				                 $direccion->numero_ext . " " .
				                 $direccion->numero_int . ", " .
				                 $direccion->colonia . ", " .
				                 $direccion->municipio_del . ", " .
				                 $direccion->cp . ", " .
				                 $direccion->estado;
				$item->usuario = $cliente;
			}

			$fecha = date_create( $item->fecha );
			setlocale( LC_TIME, "es-ES" );

			$horadeclase = new DateTime( $item->fecha . ' ' . $item->hora );
			$horaactual  = new DateTime( "now" );
			$dteDiff     = $horaactual->diff( $horadeclase );

			$dias         = intval( $dteDiff->format( "%R%d" ) ) * 24;
			$horas        = intval( $dteDiff->format( "%R%h" ) );
			$horastotales = $dias + $horas;

			$plan = Plan::where( 'reservacion_id', '=', $item->reservacionId )
			            ->get()
			            ->first();

			if ( $item->estado == 'COMENZADA' ) {
				$reservaciones = ReservacionUsuario::with( 'usuario' )
				                                   ->where( 'reservacion_id', '=', $item->id )
				                                   ->get();

				$invitados        = Invitado::where( 'reservacion_id', '=', $item->id )
				                            ->get();
				$item->invitados  = $invitados;
				$item->asistentes = $reservaciones;
			} else {
				$item->asistentes = [];
				$item->invitados  = [];
			}

			$item->tienePlan = $plan != null;
			$item->plan      = $plan;
			if ( $item->fecha == $now->toDateString() ) {
				$item->active = true;
			} else {
				$item->active = false;
			}
			array_push( $proximas, $item );
		}

		foreach ( $pasadas as &$item ) {
			date_default_timezone_set( 'America/Mexico_City' );
			if ( $item->tipo == "clase" ) {
				$horario     = Horario::with( 'condominio' )->where( 'id', '=', $item->horarioId )->get()->first();
				$item->lugar = $horario->condominio->direccion;
			} else {
				$reservacion   = Reservacion::where( 'id', '=', $item->reservacionId )->get()->first();
				$cliente       = User::with( 'detalles' )->find( $reservacion->user_id );
				$direccion     = Direccion::find( $reservacion->direccion );
				$item->lugar   = $direccion->calle . " " .
				                 $direccion->numero_ext . " " .
				                 $direccion->numero_int . ", " .
				                 $direccion->colonia . ", " .
				                 $direccion->municipio_del . ", " .
				                 $direccion->cp . ", " .
				                 $direccion->estado;
				$item->usuario = $cliente;
			}
		}


		return view( 'perfilinstructor' )
			->with( 'proximas', $proximas )
			->with( 'pasadas', $pasadas )
			->with( 'user', $user );
	}

	public function iniciarClase( $id, Request $request ) {
		$input               = $request->all();
		$reservacion         = Reservacion::find( $id );
		$reservacion->status = 'COMENZADA';
		$reservacion->inicio = Carbon::now();
		$reservacion->save();
        ReservacionUsuario::where( 'reservacion_id', '=', $id)
            ->where( 'estado', '=', 'PROXIMA')
            ->update( [ 'estado' => 'COMENZADA' ] );
		return redirect( url( '/perfilinstructor' ) );
	}

	public function terminarClase( Request $request ) {
		$input           = $request->all();
		$reserva         = Reservacion::find( $input['item_id'] );
		$reserva->status = 'EN REVISIÓN';
		$reserva->fin    = Carbon::now();
		$reserva->save();
		$reservations = Input::get( 'reservations' );
		if ( $input['tipo'] == 'clase' ) {
			ReservacionUsuario::where( 'reservacion_id', '=', $input['item_id'] )
                ->where( 'estado', '=', 'COMENZADA')
                ->update( [ 'estado' => 'EN REVISIÓN' ] );
		}
		if ( $reservations != null ) {
			foreach ( $reservations as $id ) {
				Log::debug("fin reservacion usuario",['id'=>$id]);
				$reservation             = ReservacionUsuario::find( $id );
				$reservation->asistencia = true;
				$reservation->save();
			}
		}
		Session::flash( 'mensaje', '¡Orden en revisión!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/perfilinstructor' ) );
	}

	public function agregarInvitado( Request $request ) {

	    if($request->has('email')){
		    $input = $request->all();
		    $user = User::where('email', $input['email'])->get()->first();
	    	if(empty($user)){
			    $user = User::create([
				    'name' => ucfirst($input['nombre']),
				    'email' => $input['email'],
				    'password' => bcrypt($input['password']),
				    'dob' => '',
				    'tel' => $input['telefono'],
				    'genero' => $input['genero'],
				    'code'=>str_random(6),
				    'referencia' => '',
			    ]);
		    }
            $reservacionUsuario = new ReservacionUsuario();
            $reservacionUsuario->reservacion_id = $input['reservacion_id'];
            $reservacionUsuario->usuario_id = $user->id;
            $reservacionUsuario->asistencia = true;
            $reservacionUsuario->estado='COMENZADA';
		    $reservacionUsuario->reserva = false;
            $reservacionUsuario->save();
        }else{
            $invitado = Invitado::create( $request->all() );
        }
		Session::flash( 'mensaje', '¡Participante añadido!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/perfilinstructor' ) );
	}

}