<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bancarios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;
class BancariosController extends Controller
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
       $bancario = new Bancarios();
       $bancario->banco = $request->banco;
       $bancario->cta = $request->cta;
       $bancario->clabe = $request->clabe;
       $bancario->tarjeta = $request->tarjeta;
       $bancario->adicional = $request->adicional;
       $bancario->user_id = Auth::user()->id;
       $bancario->save();
       Session::flash('mensaje', '¡Datos guardados!');
       Session::flash('class', 'success');
       return redirect()->intended(url('/perfilinstructor'));
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
      $bancario = Bancarios::where('user_id', Auth::user()->id)->first();
      $bancario->banco = $request->banco;
      $bancario->cta = $request->cta;
      $bancario->clabe = $request->clabe;
      $bancario->tarjeta = $request->tarjeta;
      $bancario->adicional = $request->adicional;
      $bancario->user_id = Auth::user()->id;
      $bancario->save();

      $datos=$bancario;

        Mail::send('emails.bancarios', ['datos'=>$datos], function ($m) use ($datos) {
            $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
            $m->to('hmuller@fitcoach.mx', 'Herman Müller')->subject('Un Coach ha actualizado su perfil.');
        });
      Session::flash('mensaje', '¡Datos actualizados!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfilinstructor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
