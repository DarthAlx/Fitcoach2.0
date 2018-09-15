<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Clase;
use App\Libres;

class ClaseController extends Controller
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
      if ($request->hasFile('imagen')) {
      $file = $request->file('imagen');
      if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


        $name = $request->nombre ."-". time(). "." . $file->getClientOriginalExtension();
        $path = base_path('uploads/clases/');

        $file-> move($path, $name);

        $guardar = new Clase($request->all());
        $guardar->imagen = $name;

        $guardar->save();
        Session::flash('mensaje', '¡Clase guardada correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/clases'));
      }
      else{
        Session::flash('mensaje', 'El archivo no es una imagen valida.');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/clases'));
      }

    }
    else{
      Session::flash('mensaje', 'El archivo no es una imagen valida.');
      Session::flash('class', 'danger');
      return redirect()->intended(url('/clases'));
    }
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

      if ($request->hasFile('imagen')) {
              $file = $request->file('imagen');
              if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
                $name = $request->nombre . "-". time()."." . $file->getClientOriginalExtension();
                $path = base_path('uploads/clases/');
                $file-> move($path, $name);
                $clase = Clase::find($request->clase_id);
                File::delete($path . $clase->imagen);
                $clase->imagen = $name;
                $clase->nombre = $request->nombre;
                $clase->tipo = $request->tipo;
                $clase->descripcion = $request->descripcion;


                $clase->save();


                Session::flash('mensaje', '¡Clase actualizada!');
                Session::flash('class', 'success');
                return redirect()->intended(url('/clases'));
              }
              else{
                Session::flash('mensaje', 'El archivo no es una imagen valida.');
                Session::flash('class', 'danger');
                return redirect()->intended(url('/clases'));
              }

            }
            else{
              $clase = Clase::find($request->clase_id);
              $clase->nombre = $request->nombre;
              $clase->tipo = $request->tipo;
              $clase->descripcion = $request->descripcion;

              $clase->save();


              Session::flash('mensaje', '¡Clase actualizada!');
              Session::flash('class', 'success');
              return redirect()->intended(url('/clases'));
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $path = base_path('uploads/clases/');
      $clase = Clase::find($request->clase_id);
      File::delete($path . $clase->imagen);
      $clase->delete();
      Session::flash('mensaje', 'Clase eliminada correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/clases'));
    }



    public function libre(Request $request)
    {
      $libre= new Libres($request->all());
      $libre->user_id=Auth::user()->id;
      $libre->save();
      
      Session::flash('mensaje', 'Día libre guardado correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfilinstructor'));
    }


    public function destroylibre(Request $request)
    {
      $libre = Libres::find($request->libre_id);
      $libre->delete();
      Session::flash('mensaje', 'Día libre eliminado correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfilinstructor'));
    }
}
