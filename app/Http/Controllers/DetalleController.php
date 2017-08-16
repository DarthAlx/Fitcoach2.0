<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Detalle;
use Illuminate\Support\Facades\Session;

class DetalleController extends Controller
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
      $usuario = User::find(Auth::user()->id);
      $dob=date_create($request->dob);
      $usuario->dob = date_format($dob,"Y-m-d");
      $usuario->tel = $request->tel;
      $usuario->save();
      $detalles = new Detalle();
      $detalles->intereses = $request->intereses;
      $detalles->user_id=Auth::user()->id;
      $detalles->save();
      Session::flash('mensaje', 'Perfil actualizado!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
    }

    public function storeinst(Request $request)
    {
      $usuario = User::find(Auth::user()->id);
      $dob=date_create($request->dob);
      $usuario->dob = date_format($dob,"Y-m-d");
      $usuario->tel = $request->tel;
      $usuario->save();
      $detalles = new Detalle();
      $detalles->rfc = $request->rfc;
      $detalles->user_id=Auth::user()->id;
      $detalles->save();
      Session::flash('mensaje', 'Perfil actualizado!');
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
      $usuario = User::find(Auth::user()->id);
      $dob=date_create($request->dob);
      $usuario->dob = date_format($dob,"Y-m-d");
      $usuario->tel = $request->tel;
      $usuario->save();
      $detalles = Detalle::where('user_id', Auth::user()->id)->first();
      $detalles->intereses = $request->intereses;
      $detalles->save();

      Session::flash('mensaje', 'Perfil actualizado!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
    }

    public function updateinst(Request $request)
    {
      $usuario = User::find(Auth::user()->id);
      $dob=date_create($request->dob);
      $usuario->dob = date_format($dob,"Y-m-d");
      $usuario->tel = $request->tel;
      $usuario->save();
      $detalles = Detalle::where('user_id', Auth::user()->id)->first();
      $detalles->rfc = $request->rfc;
      $detalles->save();

      Session::flash('mensaje', 'Perfil actualizado!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
