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
		return redirect()->intended(url('/admin-condominio'));
	}
}