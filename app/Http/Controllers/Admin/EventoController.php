<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 1/10/18
 * Time: 06:31 PM
 */

namespace App\Http\Controllers\Admin;


use App\Condominio;
use App\Evento;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventoController extends Controller {

	public function index() {
		$eventos     = Evento::where( 'condominio_id', '=', 0 )->get();
		$coaches     = User::where( 'role', 'instructor' )->get();
		$condominios = Condominio::all();

		return view( 'admin.eventos', [ 'eventos' => $eventos, 'coaches' => $coaches, 'condominios' => $condominios ] );
	}



}