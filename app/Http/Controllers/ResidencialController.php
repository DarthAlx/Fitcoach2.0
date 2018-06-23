<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grupo;
use App\Evento;
use App\Orden;
use App\Condominio;
use App\Reservacion;
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
      $guardar = new Grupo($request->all());
      $guardar->ocupados=0;
      $guardar->tipo = "En condominio";
      $guardar->save();
      Session::flash('mensaje', '¡Grupo guardado!');


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
      $grupo = Grupo::find($request->grupo_id);
      $grupo->fecha = $request->fecha;
      $grupo->hora = $request->hora;
      $grupo->user_id = $request->user_id;
      $grupo->condominio_id = $request->condominio_id;
      $grupo->clase_id = $request->clase_id;
      $grupo->precio = $request->precio;
      $grupo->audiencia = $request->audiencia;
      $grupo->tipo = "En condominio";
      $grupo->cupo = $request->cupo;
      $grupo->descripcion = $request->descripcion;

        $grupo->save();
        Session::flash('mensaje', '¡Grupo actualizado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/grupos'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $grupo = Grupo::find($request->grupo_id);
      $grupo->delete();
      Session::flash('mensaje', '¡Grupo eliminado correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/grupos'));
    }

    public function printlist($id)
  {
      $ordenes=Reservacion::where('grupo_id', $id)->get();
      $residencial=Grupo::find($id);
      $condominio=$residencial->condominio;

      /*return view('emails.list', ['ordenes'=>$ordenes,'residencial'=>$residencial,'condominio'=>$condominio]);*/
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

public function printlistevent($id)
{
  $ordenes=Orden::where('asociado', $id)->get();
  $evento=Residencial::find($id);
  $view =  \View::make('emails.listevent', ['ordenes'=>$ordenes,'evento'=>$evento])->render();
  $pdf = \App::make('dompdf.wrapper');
  $pdf->loadHTML($view);
  return $pdf->stream('list.pdf');
}








public function storeevento(Request $request)
{
  $evento = new Evento($request->all());
  

    if ($request->hasFile('imagen')) {
    $file = $request->file('imagen');
    if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


      $name = "Evento-". time(). "." . $file->getClientOriginalExtension();
      $path = base_path('uploads/clases/');

      $file-> move($path, $name);
      $evento->imagen = $name;

      $evento->save();
      Session::flash('mensaje', '¡Evento actualizado!');

    }
    else{
      Session::flash('mensaje', 'El archivo no es una imagen valida.');
      Session::flash('class', 'danger');
      return redirect()->intended(url('/eventos-admin'));
    }

  }
  else{
    Session::flash('mensaje', 'El archivo no es una imagen valida.');
    Session::flash('class', 'danger');
    return redirect()->intended(url('/eventos-admin'));
  }
  $guardar = new Grupo($request->all());
  $guardar->ocupados=0;
  $guardar->tipo="Evento";
  $guardar->evento_id=$guardar->id;
  $guardar->save();



  Session::flash('class', 'success');
  return redirect()->intended(url('/eventos-admin'));
}
public function updateevento(Request $request)
{
  $grupo = Grupo::find($request->evento_id);

  $grupo->fecha = $request->fecha;
  $grupo->hora = $request->hora;
  $grupo->user_id = $request->user_id;
  $grupo->precio = $request->precio;

  $grupo->tipo ="Evento";
  $grupo->cupo = $request->cupo;
  $grupo->descripcion=$request->descripcion;
  $evento=$grupo->evento;


    if ($request->hasFile('imagen')) {
    $file = $request->file('imagen');
    if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


      $name = "Evento-". time(). "." . $file->getClientOriginalExtension();
      $path = base_path('uploads/clases/');

      $file-> move($path, $name);
      File::delete($path . $grupo->imagenevento);
      $evento->nombre=$request->nombre;
      $evento->direccion=$request->direccion;
      $evento->imagen = $name;

      $evento->save();
      Session::flash('mensaje', '¡Evento actualizado!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/eventos-admin'));
    }
    else{
      Session::flash('mensaje', 'El archivo no es una imagen valida.');
      Session::flash('class', 'danger');
      return redirect()->intended(url('/eventos-admin'));
    }

  }
  else{
    $evento->nombre=$request->nombre;
    $evento->direccion=$request->direccion;
    $evento>save();
    Session::flash('mensaje', '¡Evento actualizado!');
    Session::flash('class', 'success');
    return redirect()->intended(url('/eventos-admin'));
  }




}
public function destroyevento(Request $request)
{
  $grupo = Grupo::find($request->evento_id);
  $evento=$grupo->evento;
  $path = base_path('uploads/clases/');
  File::delete($path . $evento->imagen);
  $evento->delete();
  $grupo->delete();
  Session::flash('mensaje', '¡Evento eliminado correctamente!');
  Session::flash('class', 'success');
  return redirect()->intended(url('/eventos-admin'));
}



















}
