<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bancarios;
use App\Documentacion;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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


     public function store2(Request $request)
     {
       $documentacion = new Documentacion();
       $user=User::find(Auth::user()->id);
       $documentacion->user_id=Auth::user()->id;
       if ($request->hasFile('rfc')) {
            $file = $request->file('rfc');
            if ($file->getClientOriginalExtension()=="pdf") {
            $name = $user->id ."-rfc-". time(). "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/documentos/');
            $file-> move($path, $name);
            $documentacion->rfc = $name;
            }
            else{
            Session::flash('mensaje', 'El archivo (rfc) no es un documento valido (PDF).');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/perfilinstructor'));
            }
    
        }


        if ($request->hasFile('ine')) {
            $file = $request->file('ine');
            if ($file->getClientOriginalExtension()=="pdf") {
            $name = $user->id ."-ine-". time(). "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/documentos/');
            $file-> move($path, $name);
            $documentacion->ine = $name;
            }
            else{
            Session::flash('mensaje', 'El archivo (ine) no es un documento valido (PDF).');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/perfilinstructor'));
            }
    
        }

        if ($request->hasFile('curp')) {
            $file = $request->file('curp');
            if ($file->getClientOriginalExtension()=="pdf") {
            $name = $user->id ."-curp-". time(). "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/documentos/');
            $file-> move($path, $name);
            $documentacion->curp = $name;
            }
            else{
            Session::flash('mensaje', 'El archivo (curp) no es un documento valido (PDF).');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/perfilinstructor'));
            }
    
        }

        if ($request->hasFile('acta')) {
            $file = $request->file('acta');
            if ($file->getClientOriginalExtension()=="pdf") {
            $name = $user->id ."-acta-". time(). "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/documentos/');
            $file-> move($path, $name);
            $documentacion->acta = $name;
            }
            else{
            Session::flash('mensaje', 'El archivo (acta de nacimiento) no es un documento valido (PDF).');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/perfilinstructor'));
            }
    
        }

        if ($request->hasFile('domicilio')) {
            $file = $request->file('domicilio');
            if ($file->getClientOriginalExtension()=="pdf") {
            $name = $user->id ."-domicilio-". time(). "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/documentos/');
            $file-> move($path, $name);
            $documentacion->domicilio = $name;
            }
            else{
            Session::flash('mensaje', 'El archivo (comprobante de domicilio) no es un documento valido (PDF).');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/perfilinstructor'));
            }
    
        }

        if ($request->hasFile('certificaciones')) {
            $file = $request->file('certificaciones');
            if ($file->getClientOriginalExtension()=="pdf") {
            $name = $user->id ."-certificaciones-". time(). "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/documentos/');
            $file-> move($path, $name);
            $documentacion->certificaciones = $name;
            }
            else{
            Session::flash('mensaje', 'El archivo (certificaciones) no es un documento valido (PDF).');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/perfilinstructor'));
            }
    
        }

        if ($request->hasFile('recomendacion1')) {
            $file = $request->file('recomendacion1');
            if ($file->getClientOriginalExtension()=="pdf") {
            $name = $user->id ."-recomendacion1-". time(). "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/documentos/');
            $file-> move($path, $name);
            $documentacion->recomendacion1 = $name;
            }
            else{
            Session::flash('mensaje', 'El archivo (carta de recomendación 1) no es un documento valido (PDF).');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/perfilinstructor'));
            }
    
        }

        if ($request->hasFile('recomendacion2')) {
            $file = $request->file('recomendacion2');
            if ($file->getClientOriginalExtension()=="pdf") {
            $name = $user->id ."-recomendacion2-". time(). "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/documentos/');
            $file-> move($path, $name);
            $documentacion->recomendacion2 = $name;
            }
            else{
            Session::flash('mensaje', 'El archivo (carta de recomendación 2) no es un documento valido (PDF).');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/perfilinstructor'));
            }
    
        }



        $documentacion->save();
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

    public function update2(Request $request)
    {
      $documentacion = Documentacion::find($request->documentacion);
      $user=User::find(Auth::user()->id);
      if ($request->hasFile('rfc')) {
        $file = $request->file('rfc');
        if ($file->getClientOriginalExtension()=="pdf") {
        $name = $user->id ."-rfc-". time(). "." . $file->getClientOriginalExtension();
        $path = base_path('uploads/documentos/');
        File::delete($path . $documentacion->rfc);
        $file-> move($path, $name);
        $documentacion->rfc = $name;
        }
        else{
        Session::flash('mensaje', 'El archivo (rfc) no es un documento valido (PDF).');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/perfilinstructor'));
        }

    }


    if ($request->hasFile('ine')) {
        $file = $request->file('ine');
        if ($file->getClientOriginalExtension()=="pdf") {
        $name = $user->id ."-ine-". time(). "." . $file->getClientOriginalExtension();
        $path = base_path('uploads/documentos/');
        File::delete($path . $documentacion->ine);
        $file-> move($path, $name);
        $documentacion->ine = $name;
        }
        else{
        Session::flash('mensaje', 'El archivo (ine) no es un documento valido (PDF).');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/perfilinstructor'));
        }

    }

    if ($request->hasFile('curp')) {
        $file = $request->file('curp');
        if ($file->getClientOriginalExtension()=="pdf") {
        $name = $user->id ."-curp-". time(). "." . $file->getClientOriginalExtension();
        $path = base_path('uploads/documentos/');
        File::delete($path . $documentacion->curp);
        $file-> move($path, $name);
        $documentacion->curp = $name;
        }
        else{
        Session::flash('mensaje', 'El archivo (curp) no es un documento valido (PDF).');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/perfilinstructor'));
        }

    }

    if ($request->hasFile('acta')) {
        $file = $request->file('acta');
        if ($file->getClientOriginalExtension()=="pdf") {
        $name = $user->id ."-acta-". time(). "." . $file->getClientOriginalExtension();
        $path = base_path('uploads/documentos/');
        File::delete($path . $documentacion->acta);
        $file-> move($path, $name);
        $documentacion->acta = $name;
        }
        else{
        Session::flash('mensaje', 'El archivo (acta de nacimiento) no es un documento valido (PDF).');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/perfilinstructor'));
        }

    }

    if ($request->hasFile('domicilio')) {
        $file = $request->file('domicilio');
        if ($file->getClientOriginalExtension()=="pdf") {
        $name = $user->id ."-domicilio-". time(). "." . $file->getClientOriginalExtension();
        $path = base_path('uploads/documentos/');
        File::delete($path . $documentacion->domicilio);
        $file-> move($path, $name);
        $documentacion->domicilio = $name;
        }
        else{
        Session::flash('mensaje', 'El archivo (comprobante de domicilio) no es un documento valido (PDF).');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/perfilinstructor'));
        }

    }

    if ($request->hasFile('certificaciones')) {
        $file = $request->file('certificaciones');
        if ($file->getClientOriginalExtension()=="pdf") {
        $name = $user->id ."-certificaciones-". time(). "." . $file->getClientOriginalExtension();
        $path = base_path('uploads/documentos/');
        File::delete($path . $documentacion->certificaciones);
        $file-> move($path, $name);
        $documentacion->certificaciones = $name;
        }
        else{
        Session::flash('mensaje', 'El archivo (certificaciones) no es un documento valido (PDF).');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/perfilinstructor'));
        }

    }

    if ($request->hasFile('recomendacion1')) {
        $file = $request->file('recomendacion1');
        if ($file->getClientOriginalExtension()=="pdf") {
        $name = $user->id ."-recomendacion1-". time(). "." . $file->getClientOriginalExtension();
        $path = base_path('uploads/documentos/');
        File::delete($path . $documentacion->recomendacion1);
        $file-> move($path, $name);
        $documentacion->recomendacion1 = $name;
        }
        else{
        Session::flash('mensaje', 'El archivo (carta de recomendación 1) no es un documento valido (PDF).');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/perfilinstructor'));
        }

    }
 
    if ($request->hasFile('recomendacion2')) {
        $file = $request->file('recomendacion2');
        if ($file->getClientOriginalExtension()=="pdf") {
        $name = $user->id ."-recomendacion2-". time(). "." . $file->getClientOriginalExtension();
        $path = base_path('uploads/documentos/');
        File::delete($path . $documentacion->recomendacion2);
        $file-> move($path, $name);
        $documentacion->recomendacion2 = $name;
        }
        else{
        Session::flash('mensaje', 'El archivo (carta de recomendación 2) no es un documento valido (PDF).');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/perfilinstructor'));
        }

    }



    $documentacion->save();
    Session::flash('mensaje', '¡Datos guardados!');
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
