<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Zona;
use Illuminate\Support\Facades\Session;

class ZonaController extends Controller
{
  public function store(Request $request){


            $guardar = new Zona($request->all());

            $guardar->save();
            Session::flash('mensaje', 'Zona guardada correctamente!');
            Session::flash('class', 'success');
            return redirect()->intended(url('/zonas'));

      }
      public function update(Request $request, $id)
      {

            $zona = Zona::find($id);

            $zona->identificador = $request->identificador;
            $zona->save();


            Session::flash('mensaje', '¡Zona actualizada!');
            Session::flash('class', 'success');
            return redirect()->intended(url('/zonas'));

      }

      public function destroy(Request $request, $id)
      {

          $zona =Zona::find($id);

          $zona->delete();
          Session::flash('mensaje', '¡Zona eliminada correctamente!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/zonas'));
      }
}
