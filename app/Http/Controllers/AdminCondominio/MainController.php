<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 1/10/18
 * Time: 07:13 PM
 */

namespace App\Http\Controllers\AdminCondominio;


use App\Clase;
use App\ReservacionUsuario;
use App\Condominio;
use App\Evento;
use App\Grupo;
use App\Horario;
use App\Http\Controllers\Controller;
use App\Plan;
use App\Reservacion;
use App\Room;
use App\Services\RoomService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MainController extends Controller {

	public function index() {
		$condominioId = Auth::user()->condominio_id;
		$now          = Carbon::now();
		$service      = new RoomService();
		$condominio   = Condominio::with( 'eventos' )
		                          ->where( 'id', '=', $condominioId )
		                          ->get()
		                          ->first();
		$rooms        = $service->getRoomsbyCondominio( $condominio->id );
		$horarios     = Horario::with( 'clase' )
		                       ->with( 'user' )
		                       ->with( 'condominio' )
		                       ->with( 'grupo.room' )
		                       ->with( 'reservaciones' )
		                       ->where( 'tipo', 'En condominio' )
		                       ->where( 'fecha', $now->toDateString() )
		                       ->where( 'condominio_id', $condominio->id )->orderBy( 'hora', 'asc' )->get();

		$eventos = Evento::where( 'condominio_id', '=', $condominioId )->get();
		$grupos  = Grupo::with( 'coach' )
		                ->with( 'horarios' )
		                ->with( 'horarios.clase' )
		                ->with( 'horarios.reservaciones' )
		                ->with( 'horarios.reservaciones.plan' )
		                ->with( 'horarios.reservaciones.invitados' )
		                ->with( 'horarios.reservaciones.user' )
		                ->with( 'room' )
		                ->with( 'clase' )
		                ->where( 'condominio_id', '=', $condominioId )
		                ->get();

		$coaches = User::where( 'role', 'instructor' )->get();
		$rooms2  = Room::all();
		$clases  = Clase::all();

		return view( 'admin_condominio.ver' )
			->with( 'condominio', $condominio )
			->with( 'hour', $now->hour )
			->with( 'date', $now->toDateString() )
			->with( 'rooms', $rooms )
			->with( 'horarios', $horarios )
			->with( 'eventos', $eventos )
			->with( 'grupos', $grupos )
			->with( 'coaches', $coaches )
			->with( 'clases', $clases )
			->with( 'rooms2', $rooms2 );
	}

	public function cancelar( $id, Request $request ) {
		$input = $request->all();
		Reservacion::where( 'horario_id', '=', $id )
		           ->where( 'tipo', '=', 'En condominio' )
		           ->update( [ 'status' => 'CANCELADA' ] );
		$horario         = Horario::find( $id );
		$horario->estado = 'CANCELADA';
		$horario->save();
		Session::flash( 'mensaje', '¡Clase cancelada!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/admin-condominio' ) );
	}
}