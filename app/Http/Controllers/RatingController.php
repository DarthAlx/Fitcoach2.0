<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rating;
use App\Detalle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class RatingController extends Controller
{

    public function store(Request $request)
    {
      $guardar = new Rating($request->all());
      $guardar->save();
      $numerodecalificaciones=Rating::where('user_id', $guardar->user_id)->count();
      $calificaciones=Rating::where('user_id', $guardar->user_id)->get();
      $promedio=0;
      if ($numerodecalificaciones!=0&&$calificaciones) {
        foreach ($calificaciones as $calificacion) {
          $promedio=$promedio+$calificacion->rate;
        }
        $promedio=$promedio/$numerodecalificaciones;
      }
      else {
        $promedio="Sin rating";
      }
      $detalles=Detalle::where('user_id', $guardar->user_id)->first();
      $user=User::find($guardar->user_id);
      $detalles->rating=$promedio;
      $user->rating=$promedio;
      $detalles->save();
      $user->save();
      Session::flash('mensaje', '¡Calificación guardada!');
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
    public function update(Request $request, $id)
    {
        //
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
