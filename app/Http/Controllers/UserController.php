<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Detalle;
use App\Particular;
use App\Residencial;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mail;

class UserController extends Controller
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

    public function userExist(Request $request)
    {
      $user = User::where('email', $request->email)->first();
      if ($user) {
        ?>true<?php
      }
      else {
        ?>false<?php
      }

    }

    public function updatePassword(Request $request){
      if ($request->password==$request->password_confirmation) {
        $user = User::find(Auth::user()->id);
        $user->password=bcrypt($request->password);
        $user->save();
        Session::flash('mensaje', '¡Contraseña actualizada!');
        Session::flash('class', 'success');
        return redirect($this->redirectPath());
      }
      else {
        Session::flash('mensaje', '¡Las contraseñas deben coincidir!');
        Session::flash('class', 'danger');
        return redirect($this->redirectPath());
      }


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
        //
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









    public function destroycliente(Request $request)
        {
          $guardar = User::find($request->user_id);

          $guardar->email="banned". "-". time();
          $guardar->role="banned";
          $guardar->password=bcrypt("banhammer");

          $guardar->save();
          Session::flash('mensaje', '¡Usuario eliminado correctamente!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/clientes'));
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
