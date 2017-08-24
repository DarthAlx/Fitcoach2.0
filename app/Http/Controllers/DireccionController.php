<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Direccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      $guardar = new Direccion($request->all());
      $guardar->user_id = Auth::user()->id;
      $guardar->save();
      Session::flash('mensaje', '!Dirección guardada!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
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
      $direccion = Direccion::find($request->direccion_id);
      $direccion->identificador = $request->identificador;
      $direccion->calle = $request->calle;
      $direccion->numero_ext = $request->numero_ext;
      $direccion->numero_int = $request->numero_int;
      $direccion->colonia = $request->colonia;
      $direccion->municipio_del = $request->municipio_del;
      $direccion->cp = $request->cp;
      $direccion->estado = $request->estado;
      $direccion->save();
      Session::flash('mensaje', '!Dirección actualizada!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $direccion = Direccion::find($request->direccion_id);
      $direccion->delete();
      Session::flash('mensaje', '!Dirección eliminada correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
    }
}
