<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 1/10/18
 * Time: 06:34 PM
 */

namespace App\Http\Controllers\AdminCondominio;


use App\Condominio;
use App\Evento;
use App\Http\Controllers\Controller;
use App\User;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EventoController extends Controller {

	public function index() {
		$condominioId = Auth::user()->condominio_id;
		$eventos      = Evento::where( 'condominio_id', '=', $condominioId )->get();
		$coaches      = User::where( 'role', 'instructor' )->get();
		$condominios  = Condominio::all();
		return view( 'admin_condominio.eventos', [ 'eventos'     => $eventos,
		                                           'coaches'     => $coaches,
		                                           'condominios' => $condominios
		] );
	}

	public function crear( Request $request ) {
		$evento                = new Evento( $request->all() );
		$evento->condominio_id = $request->condominio_id;
		$evento->ocupados      = 0;
		if ( $request->hasFile( 'imagen' ) ) {
			$file = $request->file( 'imagen' );
			if ( $file->getClientOriginalExtension() == "jpg" || $file->getClientOriginalExtension() == "png" ) {
				$name = "Evento-" . time() . "." . $file->getClientOriginalExtension();
				$path = base_path( 'uploads/clases/' );
				$file->move( $path, $name );
				$evento->imagen = $name;
				$evento->save();
				Session::flash( 'mensaje', '¡Evento actualizado!' );
			} else {
				Session::flash( 'mensaje', 'El archivo no es una imagen valida.' );
				Session::flash( 'class', 'danger' );

				return redirect()->intended( url( '/admin-condominio' ) );
			}
		} else {
			Session::flash( 'mensaje', 'El archivo no es una imagen valida.' );
			Session::flash( 'class', 'danger' );

			return redirect()->intended( url( '/admin-condominio' ) );
		}
		Session::flash( 'class', 'success' );

		return redirect()->back();
	}


	public function actualizar( Request $request ) {
		$grupo              = Evento::find( $request->evento );
		$grupo->nombre      = $request->nombre;
		$grupo->direccion   = $request->direccion;
		$grupo->fecha       = $request->fecha;
		$grupo->hora        = $request->hora;
		$grupo->precio      = $request->precio;
		$grupo->cupo        = $request->cupo;
		$grupo->descripcion = $request->descripcion;
		if ( $request->hasFile( 'imagen' ) ) {
			$file = $request->file( 'imagen' );
			if ( $file->getClientOriginalExtension() == "jpg" || $file->getClientOriginalExtension() == "png" ) {
				$name = "Evento-" . time() . "." . $file->getClientOriginalExtension();
				$path = base_path( 'uploads/clases/' );

				$file->move( $path, $name );
				File::delete( $path . $grupo->imagenevento );
				$grupo->imagen = $name;
			} else {
				Session::flash( 'mensaje', 'El archivo no es una imagen valida.' );
				Session::flash( 'class', 'danger' );

				return redirect()->intended( url( '/admin-condominio' ) );
			}

		}
		$grupo->save();
		Session::flash( 'mensaje', '¡Evento actualizado!' );
		Session::flash( 'class', 'success' );

		return redirect()->back();
	}

	public function eliminar(Request $request)
	{
		$evento = Evento::find($request->evento);
		$path = base_path('uploads/clases/');
		File::delete($path . $evento->imagen);
		$evento->delete();
		Session::flash('mensaje', '¡Evento eliminado correctamente!');
		Session::flash('class', 'success');
		return redirect()->back();
	}



}