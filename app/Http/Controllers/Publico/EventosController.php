<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 27/09/18
 * Time: 02:43 PM
 */

namespace App\Http\Controllers\Publico;


use App\Evento;
use App\EventoReservacion;
use App\Folio;
use App\Http\Controllers\Controller;
use App\Orden;
use App\Tarjeta;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Openpay;

class EventosController extends Controller {


	public function index() {
		$eventos = Evento::where( 'condominio_id', 0 )
		                 ->orderBy( 'fecha', 'asc' )->get();

		return view( 'eventos', [ 'eventos' => $eventos ] );
	}

	public function search( Request $request ) {
		$eventos = Evento::where( 'condominio_id', 0 )
		                 ->where( 'nombreevento', 'like', '%' . $request->busqueda . '%' )
		                 ->orderBy( 'nombreevento', 'asc' )->get();

		return view( 'eventos', [ 'eventos' => $eventos ] );
	}

	public function comprar( Request $request ) {
		$input  = $request->all();
		$evento = Evento::find( $input['eventoId'] );
		if ( floatval( $evento->precio ) <= 0 ) {
			$reservacion               = new EventoReservacion();
			$reservacion->evento_id    = $input['eventoId'];
			$reservacion->user_id      = Auth::user()->id;
			$reservacion->valor_pagado = $evento->precio;
			$reservacion->estado       = 'PROXIMA';
			$reservacion->save();
			$evento->ocupados += 1;
			$evento->save();

			return redirect()->intended( url( '/eventos/reservado/' . $evento->id ) );

		} else {
			return view( 'eventos.compra' )
				->with( 'evento', $evento );
		}
	}

	public function reservado( $eventoId ) {
		$evento = Evento::find( $eventoId );

		return view( 'eventos.finalizado' )
			->with( 'evento', $evento );
	}

	public function pago( Request $request ) {
		$input = $request->all();
		require 'vendor/autoload.php';
		$user   = User::find( Auth::user()->id );
		$evento = Evento::find( $input['evento_id'] );

		header( 'Content-Type: text/html; charset=utf-8' );
		$openpay = Openpay::getInstance( 'mtxcxt534uf7g731pnty', 'sk_c1feb84d5c534a72a698e0d135e5d1d3' );
		Openpay::setProductionMode( true );
		$customer = array(
			'name'         => $user->name,
			'last_name'    => "",
			'phone_number' => $user->tel,
			'email'        => $user->email
		);
		$total    = $evento->precio;
		//pago con tarjeta

		try {
			$folio      = Folio::first();
			$chargeData = array(
				'method'            => 'card',
				'source_id'         => $request->token_id,
				'amount'            => $total,
				'currency'          => 'MXN',
				'description'       => "Evento " . $evento->nombre,
				'order_id'          => $folio->folio,
				'device_session_id' => $_POST["deviceIdHiddenFieldName"],
				'customer'          => $customer
			);
			$charge     = $openpay->charges->create( $chargeData );

			if ( $request->tarjeta == "" && $request->identificadortarjeta ) {
				$tarjeta                = new Tarjeta();
				$tarjeta->identificador = $request->identificadortarjeta;
				$tarjeta->num           = $request->numero;
				$tarjeta->nombre        = $request->nombre;
				$tarjeta->mes           = $request->mes;
				$tarjeta->año           = $request->año;
				$tarjeta->user_id       = Auth::user()->id;
				$tarjeta->save();
			}

			$guardar           = new Orden();
			$guardar->order_id = $charge->id;
			$guardar->folio    = "W" . $folio->folio;
			$guardar->user_id  = Auth::user()->id;

			$guardar->cantidad  = $total;
			$guardar->descuento = 0;
			$guardar->status    = 'PAGADA';
			$guardar->save();

			$reservacion               = new EventoReservacion();
			$reservacion->evento_id    = $input['eventoId'];
			$reservacion->user_id      = Auth::user()->id;
			$reservacion->valor_pagado = $evento->precio;
			$reservacion->estado       = 'PROXIMA';
			$reservacion->save();
			$evento->ocupados += 1;
			$evento->save();
			$folio->folio ++;
			$folio->save();
			$this->sendinvoice( $guardar->id );

			return redirect()->intended( url( '/eventos/reservado/' . $evento->id ) );
		} //ERRORES
		catch ( \OpenpayApiTransactionError $e ) {
			$Motivo = 'ERROR de transacción: ' . $e->getMessage();
			Session::flash( 'mensaje', $Motivo );
			Session::flash( 'class', 'danger' );

			return back();

		} catch ( \OpenpayApiRequestError $e ) {
			$Motivo = 'ERROR en la petición: ' . $e->getMessage();
			Session::flash( 'mensaje', $Motivo );
			Session::flash( 'class', 'danger' );

			return back();

		} catch ( \OpenpayApiConnectionError $e ) {
			$Motivo = 'ERROR en la conexión: ' . $e->getMessage();
			Session::flash( 'mensaje', $Motivo );
			Session::flash( 'class', 'danger' );

			return back();

		} catch ( \OpenpayApiAuthError $e ) {
			$Motivo = 'ERROR en la autenticación de la API: ' . $e->getMessage();
			Session::flash( 'mensaje', $Motivo );
			Session::flash( 'class', 'danger' );

			return back();

		} catch ( \OpenpayApiError $e ) {
			$Motivo = 'ERROR de API: ' . $e->getMessage();
			Session::flash( 'mensaje', $Motivo );
			Session::flash( 'class', 'danger' );

			return back();

		} catch ( \Exception $e ) {
			$Motivo = 'ERROR en el script: ' . $e->getMessage();
			Session::flash( 'mensaje', $Motivo );
			Session::flash( 'class', 'danger' );

			return back();
		}

	}


}