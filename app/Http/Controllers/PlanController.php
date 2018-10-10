<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller {
	public function store( Request $request ) {
		$input = $request->all();
		$plan  = Plan::create($input);
		Session::flash( 'mensaje', '¡Datos guardados!' );
		Session::flash( 'class', 'success' );
		return redirect()->intended( url( '/perfilinstructor' ) );
	}


	public function update( Request $request ) {
		$plan                 = Plan::where( 'user_id', Auth::user()->id )->first();
		$plan->inicio         = $request->inicio;
		$plan->medular        = $request->medular;
		$plan->final          = $request->final;
		$plan->minutosinicio  = $request->minutosinicio;
		$plan->minutosmedular = $request->minutosmedular;
		$plan->minutosfinal   = $request->minutosfinal;
		$plan->minutosmedular = $request->minutosmedular;
		$plan->comentarios    = $request->comentarios;
		$plan->reservacion_id = $request->reservacion_id;
		$plan->save();


		Session::flash( 'mensaje', '¡Datos actualizados!' );
		Session::flash( 'class', 'success' );

		return redirect()->intended( url( '/perfilinstructor' ) );
	}
}
