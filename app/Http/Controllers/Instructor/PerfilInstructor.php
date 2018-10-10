<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 11/09/18
 * Time: 06:23 PM
 */

namespace App\Http\Controllers\Instructor;


use App\Clase;
use App\ClaseHistorial;
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

			if ( $item->tipo == 'clase' ) {
				$plan = Plan::where( 'item_id', '=', $item->horarioId )
				            ->where( 'tipo', 'clase' )
				            ->get()
				            ->first();
			} else {
				$plan = Plan::where( 'item_id', '=', $item->reservacionId )
				            ->where( 'tipo', 'reserva' )
				            ->get()
				            ->first();
			}

			if($item->estado == 'COMENZADA'){
				$reservaciones = Reservacion::with('user')->where('horario_id','=',$item->horarioId)
					->get();

				$invitados = Invitado::where('horario_id','=',$item->horarioId)
				                     ->get();
				$item->invitados = $invitados;
				$item->asistentes = $reservaciones;
			}else{
				$item->asistentes = [];
				$item->invitados = [];
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

		return view( 'perfilinstructor' )
			->with( 'proximas', $proximas )
			->with( 'user', $user );
	}

	public function iniciarClase( $id, Request $request ) {
		$input                   = $request->all();
		$claseHistorial          = new ClaseHistorial();
		$claseHistorial->tipo    = $input['tipo'];
		$claseHistorial->item_id = $id;
		$claseHistorial->evento  = 'inicio';
		$claseHistorial->save();
		if ( $input['tipo'] == 'reserva' ) {
			$reserva         = Reservacion::find( $id );
			$reserva->status = 'COMENZADA';
			$reserva->save();
		} else {
			Reservacion::where( 'horario_id', '=', $id )
			           ->update( [ 'status' => 'COMENZADA' ] );
		}

		return redirect( url( '/perfilinstructor' ) );
	}

	public function terminarClase( Request $request ) {
		$input                   = $request->all();
		$claseHistorial          = new ClaseHistorial();
		$claseHistorial->tipo    = $input['tipo'];
		$claseHistorial->item_id = $input['item_id'];
		$claseHistorial->evento  = 'fin';
		$claseHistorial->save();
		$reservations=  Input::get('reservations');
		if ( $input['tipo'] == 'reserva' ) {
			$reserva         = Reservacion::find( $input['item_id'] );
			$reserva->status = 'EN REVISIÓN';
			$reserva->save();
		} else {
			Reservacion::where( 'horario_id', '=', $input['item_id'] )
			           ->update( [ 'status' => 'EN REVISIÓN' ] );
		}
		foreach ($reservations as $id){
			$reservation = Reservacion::find($id);
			$reservation->asistencia = true;
			$reservation->save();
		}

		Session::flash( 'mensaje', '¡Orden en revisión!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/perfilinstructor' ) );
	}

	public function agregarInvitado(Request $request){

		$invitado = Invitado::create($request->all());
		Session::flash( 'mensaje', '¡Participante añadido!' );
		Session::flash( 'class', 'success' );
		return redirect()->intended( url( '/perfilinstructor' ) );
	}

}