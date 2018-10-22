<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 21/10/18
 * Time: 05:30 PM
 */

namespace App\Http\Controllers\Publico;


use App\Http\Controllers\Controller;
use App\Paquete;
use App\Slider;
use Conekta\Log;
use Illuminate\Http\Request;

class HomeController extends Controller {

	public function index(Request $request) {
		$particulares  = Paquete::where( 'tipo', 'A domicilio' )->get();
		$residenciales = Paquete::where( 'tipo', 'En condominio' )->get();
		$sliders       = Slider::orderBy( 'order', 'asc' )->get();

		return view( 'inicio', [
			'sliders'       => $sliders,
			'particulares'  => $particulares,
			'residenciales' => $residenciales
		] );
	}

}