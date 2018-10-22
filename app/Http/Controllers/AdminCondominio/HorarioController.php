<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 1/10/18
 * Time: 10:59 PM
 */

namespace App\Http\Controllers\AdminCondominio;


use App\Grupo;
use App\Horario;
use App\Http\Controllers\Controller;
use App\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HorarioController extends Controller {

	public function crear( Request $request ) {
		$guardar           = new Horario( $request->all() );
		$guardar->ocupados = 0;
		$guardar->tipo     = "En condominio";
		$guardar->save();
		$grupo                  = Grupo::with( ['clase','condominio'] )->find( $guardar->grupo_id );
		$reservacion            = new Reservacion();
		$reservacion->fecha  = $guardar->fecha;
		$reservacion->hora   = $guardar->hora;
		$reservacion->tipo = 'En condominio';
		$reservacion->horario_id  = $guardar->id;
		$reservacion->coach_id   = $guardar->user_id;
		$reservacion->nombre    = $grupo->clase->nombre;
		$reservacion->direccion = $grupo->condominio->identificador . ". ".$grupo->condominio->direccion;
		$reservacion->status    = 'PROXIMA';
		$reservacion->tokens    = 0;
		$reservacion->save();
		Session::flash( 'mensaje', '¡Horario guardado!' );
		Session::flash( 'class', 'success' );

		return redirect()->back();
	}
}