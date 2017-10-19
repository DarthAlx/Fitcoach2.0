<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Particular;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ParticularController extends Controller
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
      $guardar = new Particular($request->all());
      if ($request->recurrencia) {
        $guardar->recurrencia=implode(",", $request->recurrencia);
        $guardar->fecha="";
      }
      else {
        $guardar->fecha = date_create($request->fecha);
        $guardar->recurrencia="";
      }

      $guardar->user_id = Auth::user()->id;
      $guardar->save();
      Session::flash('mensaje', '¡Horario guardado!');
      Session::flash('class', 'success');
      return redirect($this->redirectPath());
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
      $horario = Particular::find($request->horario_id);
      $horario->clase_id = $request->clase_id;
      $horario->hora = $request->hora;
      if ($request->recurrencia) {
        $horario->recurrencia=implode(",", $request->recurrencia);
        $horario->fecha ="";
      }
      else {
        $horario->fecha = date_create($request->fecha);
        $horario->recurrencia="";
      }
      $horario->zona_id = $request->zona_id;
      $horario->save();
      Session::flash('mensaje', '¡Horario actualizado!');
      Session::flash('class', 'success');
      return redirect($this->redirectPath());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $horario = Particular::find($request->horario_id);
      $horario->delete();
      Session::flash('mensaje', '¡Horario eliminado correctamente!');
      Session::flash('class', 'success');
      return redirect($this->redirectPath());
    }

    public function redirectPath()
    {
      $usuario = User::find(Auth::user()->id);
      if (Auth::user()->role=="superadmin" || Auth::user()->role=="admin") {
        return url('/admin');
      }
      if (Auth::user()->role=="instructor") {
        return url('/perfilinstructor');
      }
      else {
          return url('/perfil');
      }


    }
}
