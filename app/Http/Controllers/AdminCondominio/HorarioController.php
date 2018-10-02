<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 1/10/18
 * Time: 10:59 PM
 */

namespace App\Http\Controllers\AdminCondominio;


use App\Horario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HorarioController extends Controller {

	public function crear(Request $request)
	{
		$guardar = new Horario($request->all());
		$guardar->ocupados=0;
		$guardar->tipo = "En condominio";
		$guardar->save();
		Session::flash('mensaje', '¡Horario guardado!');
		Session::flash('class', 'success');
		return redirect()->intended(url('/admin-condominio'));
	}
}