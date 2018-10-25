<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 22/10/18
 * Time: 10:30 PM
 */

namespace App\Http\Controllers\AdminCondominio;


use App\Clase;
use App\Detalle;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;

class InstructorController extends Controller {

	public function clases( $coachId ) {
		$user     = User::find( $coachId );
		$detalles = Detalle::where( 'user_id', $coachId )
		                   ->get()
		                   ->first();
		if ( $detalles != null ) {
			$clasesIds = explode( ",", $detalles->clases );
			$clases    = Clase::whereIn( 'id', $detalles )->get();

			return response()->json( $clases->toArray() );
		} else {
			return response()->json( [] );

		}
	}
}