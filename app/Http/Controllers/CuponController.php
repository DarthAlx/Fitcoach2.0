<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cupon;
use Illuminate\Support\Facades\Session;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cupones = Cupon::all();
        return view('admin.cupones', ['cupones'=>$cupones]);
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
       $guardar = new Cupon($request->all());
       $guardar->expiracion = date_create($request->expiracion);
       $guardar->save();
       Session::flash('mensaje', '¡Cupón creado!');
       Session::flash('class', 'success');
       return redirect()->intended(url('/cupones'));
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
       $cupon = Cupon::find($request->cupon_id);
       $cupon->descripcion = $request->descripcion;
       $cupon->codigo = $request->codigo;
       $cupon->monto = $request->monto;
       $cupon->usos = $request->usos;
       $cupon->minimo = $request->minimo;
       $cupon->expiracion = date_create($request->expiracion);
       $cupon->user_id = $request->user_id;
       $cupon->tipo = $request->tipo;
       $cupon->maximo = $request->maximo;
       $cupon->save();
       Session::flash('mensaje', '¡Cupón actualizado!');
       Session::flash('class', 'success');
       return redirect()->intended(url('/cupones'));
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request)
     {
       $cupon = Cupon::find($request->cupon_id);
       $cupon->delete();
       Session::flash('mensaje', '¡Cupón eliminado correctamente!');
       Session::flash('class', 'success');
       return redirect()->intended(url('/cupones'));
     }
}
