<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Orden;
use App\Particular;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cart;
use App\User;
use App\Tarjeta;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartinst(Request $request)
    {
      foreach ($request->carrito as $item) {

        $items=explode(",",$item);
        $clase=Particular::find($items[0]);
        Cart::add($clase->clase->id,$clase->clase->nombre,1,$clase->clase->precio, ['tipo'=>$clase->clase->tipo,'fecha' => $items[1],'hora' => $clase->hora, 'coach' => $clase->user_id]);
      }


    $items=Cart::content();
    return view('cart.cart',['items'=>$items]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $orden = Orden::find($request->ordencancelar);
      $orden->status = 'cancelada';
      $orden->save();
      Session::flash('mensaje', 'Orden cancelada!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
      Cart::remove($rowId);
      Session::flash('mensaje', 'La clase se eliminó del carrito.');
      Session::flash('class', 'success');
      return redirect()->intended(url('/carrito'));
    }

    public function llenar_direcciones(Request $request){
      $direccion=App\Direccion::find($request->direccion);
    }
    public function cargartarjeta(Request $request)
    {
      $tarjeta = Tarjeta::find($request->tarjeta);
    
      echo $tarjeta->num.",".$tarjeta->nombre.",".$tarjeta->mes.",".$tarjeta->año;
    }
}
