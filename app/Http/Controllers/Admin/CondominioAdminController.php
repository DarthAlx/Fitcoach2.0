<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 24/09/18
 * Time: 09:39 PM
 */

namespace App\Http\Controllers\Admin;


use App\Clase;
use App\Condominio;
use App\Evento;
use App\Grupo;
use App\Horario;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdministradorCondominioRequest;
use App\Http\Requests\Request;
use App\Room;
use App\Services\RoomService;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CondominioAdminController extends Controller {
	public function show() {
		$usuarios    = User::has( 'condominioAdmin' )->get();
		$condominios = Condominio::all();

		return view( 'admin.condominio_admins', [
			'usuarios'    => $usuarios,
			'condominios' => $condominios
		] );
	}


	public function admin( $condominioId ) {
		$now        = Carbon::now();
		$service    = new RoomService();
		$condominio = Condominio::with( 'eventos' )
		                        ->where( 'id', '=', $condominioId )
		                        ->get()
		                        ->first();
		$rooms      = $service->getRoomsbyCondominio( $condominio->id );
		$horarios   = Horario::with( 'clase' )
		                     ->with( 'user' )
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
		                ->with( 'horarios.reservaciones.asistentes' )
		                ->with( 'horarios.reservaciones.user' )
		                ->with( 'horarios.reservaciones.mensajes' )
		                ->with( 'room' )
		                ->with( 'clase' )
		                ->where( 'condominio_id', '=', $condominioId )
		                ->get();

		$coaches = User::where( 'role', 'instructor' )->get();
		$rooms2  = Room::all();

		return view( 'admin_condominio.ver' )
			->with( 'condominio', $condominio )
			->with( 'hour', $now->hour )
			->with( 'date', $now->toDateString() )
			->with( 'rooms', $rooms )
			->with( 'horarios', $horarios )
			->with( 'eventos', $eventos )
			->with( 'grupos', $grupos )
			->with( 'coaches', $coaches )
			->with( 'rooms2', $rooms2 );
	}


	public function create( CreateAdministradorCondominioRequest $request ) {

		$guardar           = new User( $request->all() );
		$guardar->password = bcrypt( $request->password );
		if ( isset( $request->editor ) ) {
			$guardar->editor = 1;
		} else {
			$guardar->editor = 0;
		}
		$guardar->save();
		Session::flash( 'mensaje', '¡Usuario guardado!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/condominio-admins' ) );
	}

	public function update( CreateAdministradorCondominioRequest $request ) {
		$guardar         = User::find( $request->admin_id );
		$guardar->name   = $request->name;
		$guardar->email  = $request->email;
		$guardar->dob    = $request->dob;
		$guardar->tel    = $request->tel;
		$guardar->genero = $request->genero;
		if ( $request->has( 'condominio_id' ) ) {
			$guardar->condominio_id = $request->condominio_id;
		}
		if ( $request->password ) {
			$guardar->password = bcrypt( $request->password );
		}
		$guardar->save();
		Session::flash( 'mensaje', '¡Usuario actualizado!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/condominio-admins' ) );
	}

	public function destroy( Request $request ) {
		$guardar           = User::find( $request->admin_id );
		$guardar->email    = "banned" . "-" . time();
		$guardar->role     = "banned";
		$guardar->password = bcrypt( "banhammer" );
		$guardar->save();
		Session::flash( 'mensaje', '¡Usuario eliminado correctamente!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/condominio-admins' ) );
	}
}