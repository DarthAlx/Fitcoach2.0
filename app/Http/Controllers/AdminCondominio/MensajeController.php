<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 15/10/18
 * Time: 06:36 PM
 */

namespace App\Http\Controllers\AdminCondominio;


use App\Http\Controllers\Controller;
use App\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MensajeController extends Controller {

	public function guardar(Request $request){
		$input = $request->all();
		$mensaje = new Mensaje();
		$mensaje->mensaje = $input['mensaje'];
		$mensaje->user_id = $input['user_id'];
		$mensaje->reservacion_id = $input['reservacion_id'];
		$mensaje->save();
		Session::flash('mensaje', '¡Mensaje guardado correctamente!');
		Session::flash('class', 'success');
		return redirect()->intended(url('/admin-condominio'));
	}

}