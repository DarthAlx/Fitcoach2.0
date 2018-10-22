<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 1/10/18
 * Time: 09:53 PM
 */

namespace App\Http\Controllers\AdminCondominio;


use App\Grupo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GrupoController extends Controller {

	public function store(Request $request)
	{
		$guardar = new Grupo($request->all());
		$guardar->save();
		Session::flash('mensaje', '¡Grupo guardado!');
		Session::flash('class', 'success');
		return redirect()->back();
	}

	public function update( Request $request ) {
		$grupo                = Grupo::find( $request->grupo_id );
		$grupo->nombre        = $request->nombre;
		$grupo->condominio_id = $request->condominio_id;
		$grupo->room_id       = $request->room_id;
		$grupo->descripcion   = $request->descripcion;
		$grupo->audiencia   = $request->audiencia;
		$grupo->save();
		Session::flash( 'mensaje', '¡Grupo actualizado!' );
		Session::flash( 'class', 'success' );

		return redirect()->back();
	}


	public function remove(Request $request)
	{
		$grupo = Grupo::find($request->grupo_id);
		$grupo->delete();
		Session::flash('mensaje', '¡Grupo desactivado correctamente!');
		Session::flash('class', 'success');
		return redirect()->back();
	}
}