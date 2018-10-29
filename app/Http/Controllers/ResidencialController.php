<?php

namespace App\Http\Controllers;

use App\Condominio;
use App\Evento;
use App\Grupo;
use App\Horario;
use App\Orden;
use App\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ResidencialController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$guardar = new Grupo( $request->all() );
		$guardar->save();
		Session::flash( 'mensaje', '¡Grupo guardado!' );


		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/grupos' ) );
	}

	public function store2( Request $request ) {
		$guardar           = new Horario( $request->all() );
		$guardar->ocupados = 0;
		$guardar->tipo     = "En condominio";
		$guardar->save();
		$grupo                   = Grupo::with( 'clase' )->find( $guardar->id );
		$reservacion             = new Reservacion();
		$reservacion->grupo_id = $guardar->id;
		$reservacion->user_id = $guardar->user_id;
		$reservacion->nombre     = $grupo->clase->nombre;
		$reservacion->direccion  = $grupo->grupo->condominio->identificador . ". " . $grupo->grupo->condominio->direccion;
		$reservacion->status     = 'PROXIMA';
		$reservacion->tokens     = 0;
		$reservacion->save();
		Session::flash( 'mensaje', '¡Horario guardado!' );


		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/grupos' ) );
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request ) {
		$grupo                = Grupo::find( $request->grupo_id );
		$grupo->nombre        = $request->nombre;
		$grupo->condominio_id = $request->condominio_id;
		$grupo->room_id       = $request->room_id;
		$grupo->descripcion   = $request->descripcion;
		$grupo->save();
		Session::flash( 'mensaje', '¡Grupo actualizado!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/grupos' ) );


	}

	public function update2( Request $request ) {
		$grupo        = Horario::find( $request->horario_id );
		$grupo->fecha = $request->fecha;
		$grupo->hora  = $request->hora;


		$grupo->save();
		Session::flash( 'mensaje', '¡Horario actualizado!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/grupos' ) );


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Request $request ) {
		$grupo = Grupo::find( $request->grupo_id );
		$grupo->delete();
		Session::flash( 'mensaje', '¡Grupo eliminado correctamente!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/grupos' ) );
	}

	public function destroy2( Request $request ) {
		$grupo = Horario::find( $request->horario_id );
		$grupo->delete();
		Session::flash( 'mensaje', '¡Horario eliminado correctamente!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/grupos' ) );
	}

	public function printlist( $id, Request $request ) {
		if($request->tipo=='evento'){
			$evento = Evento::with( 'asistentes' )
			                 ->with( 'asistentes.usuario' )
			                 ->where( 'id', '=', $id )->get()->first();
			return view( 'emails.event', [ 'evento' => $evento] );
		}else{
			$input      = $request->all();
			$reservacion = Reservacion::with(['invitados','asistentes','asistentes.usuario'])->find($id);
			$horario    = Horario::find( $reservacion->horario_id );
			$condominio = $horario->condominio;

			return view( 'emails.list', [ 'reservacion' => $reservacion, 'horario' => $horario, 'condominio' => $condominio ] );
		}

		/*$view =  \View::make('emails.list', ['ordenes'=>$ordenes,'horario'=>$horario,'condominio'=>$condominio])->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->stream('list.pdf');*/
	}

	public function printgroups( $id ) {
		$condominio    = Condominio::where( 'id', $id )->first();
		$residenciales = $condominio->residenciales;
		$view          = \View::make( 'emails.group', [
			'residenciales' => $residenciales,
			'condominio'    => $condominio
		] )->render();
		$pdf           = \App::make( 'dompdf.wrapper' );
		$pdf->loadHTML( $view );

		return $pdf->stream( 'group.pdf' );
	}

	public function printlistevent( $id ) {
		$ordenes = Orden::where( 'asociado', $id )->get();
		$evento  = Residencial::find( $id );
		$view    = \View::make( 'emails.listevent', [ 'ordenes' => $ordenes, 'evento' => $evento ] )->render();
		$pdf     = \App::make( 'dompdf.wrapper' );
		$pdf->loadHTML( $view );

		return $pdf->stream( 'list.pdf' );
	}


	public function storeevento( Request $request ) {
		$evento           = new Evento( $request->all() );
		$evento->ocupados = 0;

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

				return redirect()->intended( url( '/eventos-admin' ) );
			}

		} else {
			Session::flash( 'mensaje', 'El archivo no es una imagen valida.' );
			Session::flash( 'class', 'danger' );

			return redirect()->intended( url( '/eventos-admin' ) );
		}


		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/eventos-admin' ) );
	}

	public function updateevento( Request $request ) {
		$grupo                = Evento::find( $request->evento );
		$grupo->nombre        = $request->nombre;
		$grupo->direccion     = $request->direccion;
		$grupo->fecha         = $request->fecha;
		$grupo->hora          = $request->hora;
		$grupo->precio        = $request->precio;
		$grupo->cupo          = $request->cupo;
		$grupo->descripcion   = $request->descripcion;
		$grupo->condominio_id = $request->condominio_id;


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

				return redirect()->intended( url( '/eventos-admin' ) );
			}

		}

		$grupo->save();
		Session::flash( 'mensaje', '¡Evento actualizado!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/eventos-admin' ) );


	}

	public function destroyevento( Request $request ) {
		$evento = Evento::find( $request->evento );
		$path   = base_path( 'uploads/clases/' );
		File::delete( $path . $evento->imagen );
		$evento->delete();
		Session::flash( 'mensaje', '¡Evento eliminado correctamente!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/eventos-admin' ) );
	}


}
