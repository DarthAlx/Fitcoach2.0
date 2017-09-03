<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Condominio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CondominioController extends Controller
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
        $path = base_path('uploads/condominios/');

        $file-> move($path, $name);

        $guardar = new Condominio($request->all());
        $guardar->imagen = $name;

        $guardar->save();
        Session::flash('mensaje', '!Condominio guardado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/condominios'));
      }
      else{
        Session::flash('mensaje', 'El archivo no es una imagen valida.');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/condominios'));
      }

    }
    else{
      Session::flash('mensaje', 'El archivo no es una imagen valida.');
      Session::flash('class', 'danger');
      return redirect()->intended(url('/condominios'));
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
                $name = $request->identificador . "-". time()."." . $file->getClientOriginalExtension();
                $path = base_path('uploads/condominios/');
                $file-> move($path, $name);
                $condominio = Condominio::find($request->condominio_id);
                $condominio->identificador = $request->identificador;
                $condominio->direccion = $request->direccion;
                File::delete($path . $condominio->imagen);
                $condominio->imagen = $name;
                $condominio->save();


                Session::flash('mensaje', '!Condominio actualizado!');
                Session::flash('class', 'success');
                return redirect()->intended(url('/condominios'));
              }
              else{
                Session::flash('mensaje', 'El archivo no es una imagen valida.');
                Session::flash('class', 'danger');
                return redirect()->intended(url('/condominios'));
              }

            }
            else{
              $condominio = Condominio::find($request->condominio_id);
              $condominio->identificador = $request->identificador;
              $condominio->direccion = $request->direccion;
              $condominio->save();


              Session::flash('mensaje', '!Condominio actualizado!');
              Session::flash('class', 'success');
              return redirect()->intended(url('/condominios'));
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
      $path = base_path('uploads/condominios/');
      $condominio = Condominio::find($request->condominio_id);
      File::delete($path . $condominio->imagen);
      $condominio->delete();
      Session::flash('mensaje', '!Condominio eliminado correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/condominios'));
    }
}
