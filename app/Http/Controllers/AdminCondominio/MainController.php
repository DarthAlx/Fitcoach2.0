<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 1/10/18
 * Time: 07:13 PM
 */

namespace App\Http\Controllers\AdminCondominio;


use App\Clase;
use App\Condominio;
use App\Evento;
use App\Grupo;
use App\Horario;
use App\Http\Controllers\Controller;
use App\Plan;
use App\Room;
use App\Services\RoomService;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
		                ->with( 'horarios.invitados' )
		                ->with( 'horarios.reservaciones.user' )
		                ->with( 'room' )
		                ->with( 'clase' )
		                ->where( 'condominio_id', '=', $condominioId )
		                ->get();
		$planes=[];
		foreach ( $horarios as $horario ) {
			$plan = Plan::where( 'item_id', '=', $horario->id )
			            ->where( 'tipo', 'clase' )
			            ->get()
			            ->first();
			$planes[$horario->id] = $plan;
		}

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
			->with( 'rooms2', $rooms2 )
			->with( 'planes', $planes);
	}
}