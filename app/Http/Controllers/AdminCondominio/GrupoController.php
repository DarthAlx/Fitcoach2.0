<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 1/10/18
 * Time: 09:53 PM
 */

namespace App\Http\Controllers\AdminCondominio;


use App\Http\Controllers\Controller;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GrupoController extends Controller {

	public function store(Request $request)
	{
		$guardar = new Grupo($request->all());
		$guardar->save();
		Session::flash('mensaje', '¡Grupo guardado!');
		Session::flash('class', 'success');
		return redirect()->intended(url('/admin-condominio'));
	}

	public function remove(Request $request)
	{
		$grupo = Grupo::find($request->grupo_id);
		$grupo->delete();
		Session::flash('mensaje', '¡Grupo desactivado correctamente!');
		Session::flash('class', 'success');
		return redirect()->intended(url('/admin-condominio'));
	}
}