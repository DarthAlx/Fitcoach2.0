<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Residencial;
use App\Orden;
use App\Condominio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ResidencialController extends Controller
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
      $guardar = new Residencial($request->all());
      $guardar->ocupados=0;

      if ($guardar->tipo="Evento") {
        if ($request->hasFile('imagenevento')) {
        $file = $request->file('imagenevento');
        if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


          $name = $request->nombreevento ."-". time(). "." . $file->getClientOriginalExtension();
          $path = base_path('uploads/clases/');

          $file-> move($path, $name);

          $guardar->nombreevento=$request->nombreevento;
          $guardar->direccionevento=$request->direccionevento;
          $guardar->imagenevento = $name;

          $guardar->save();
          Session::flash('mensaje', '¡Evento actualizado!');

        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/grupos'));
        }

      }
      else{
        Session::flash('mensaje', 'El archivo no es una imagen valida.');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/grupos'));
      }

      }
      else {
        $guardar->save();
        Session::flash('mensaje', '¡Grupo guardado!');
      }

      Session::flash('class', 'success');
      return redirect()->intended(url('/grupos'));
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
      $grupo = Residencial::find($request->grupo_id);
      $grupo->fecha = $request->fecha;
      $grupo->hora = $request->hora;
      $grupo->user_id = $request->user_id;
      $grupo->condominio_id = $request->condominio_id;
      $grupo->clase_id = $request->clase_id;
      $grupo->precio = $request->precio;
      $grupo->audiencia = $request->audiencia;
      $grupo->tipo = $request->tipo;
      $grupo->cupo = $request->cupo;
      $grupo->descripcion = $request->descripcion;
      if ($request->tipo=="Evento") {
        if ($request->hasFile('imagenevento')) {
        $file = $request->file('imagenevento');
        if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


          $name = $request->nombreevento ."-". time(). "." . $file->getClientOriginalExtension();
          $path = base_path('uploads/clases/');

          $file-> move($path, $name);

          $grupo->nombreevento=$request->nombreevento;
          $grupo->direccionevento=$request->direccionevento;
          $grupo->imagenevento = $name;

          $grupo->save();
          Session::flash('mensaje', '¡Evento actualizado!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/grupos'));
        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/grupos'));
        }

      }
      else{
        Session::flash('mensaje', 'El archivo no es una imagen valida.');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/grupos'));
      }

      }
      else {
        $grupo->save();
        Session::flash('mensaje', '¡Grupo actualizado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/grupos'));
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
      $grupo = Residencial::find($request->grupo_id);
      $grupo->delete();
      Session::flash('mensaje', '¡Grupo eliminado correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/grupos'));
    }

    public function printlist($id)
  {
      $ordenes=Orden::where('asociado', $id)->get();
      $residencial=Residencial::find($id);
      $condominio=$residencial->condominio;
      $view =  \View::make('emails.list', ['ordenes'=>$ordenes,'residencial'=>$residencial,'condominio'=>$condominio])->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('list.pdf');
  }
  public function printgroups($id)
{
    $condominio=Condominio::where('id', $id)->first();
    $residenciales=$condominio->residenciales;
    $view =  \View::make('emails.group', ['residenciales'=>$residenciales,'condominio'=>$condominio])->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view);
    return $pdf->stream('group.pdf');
}
}
