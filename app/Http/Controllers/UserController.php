<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Detalle;
use Validator;

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
        Session::flash('mensaje', '!Contraseña actualizada!');
        Session::flash('class', 'success');
        return redirect($this->redirectPath());
      }
      else {
        Session::flash('mensaje', '!Las contraseñas deben coincidir!');
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    public function storeadmin(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else {
          $guardar = new User($request->all());
          $guardar->role="admin";
          $guardar->password=bcrypt($request->password);
          $guardar->save();
          $permisos = new Detalle();
          if ($request->permisos) {
            $permisos->permisos=implode(",", $request->permisos);
            $permisos->user_id=$guardar->id;
          }
          $permisos->save();
          Session::flash('mensaje', '¡Admin guardado!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/admins'));
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

     protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'password' => 'confirmed|min:6'
        ]);
    }
    public function updateadmin(Request $request)
    {
      $validator = $this->validatorUpdate($request->all());

      if ($validator->fails()) {
          $this->throwValidationException(
              $request, $validator
          );
      }
      else {
        $guardar = User::find($request->admin_id);
        $guardar->name=$request->name;
        $guardar->email=$request->email;
        $guardar->dob=$request->dob;
        $guardar->tel=$request->tel;
        $guardar->genero=$request->genero;
        if ($request->password) {
          $guardar->password=bcrypt($request->password);
        }

        $guardar->role="admin";
        $guardar->save();
        $permisos = Detalle::find($guardar->detalles->id);
        if ($request->permisos) {
          $permisos->permisos=implode(",", $request->permisos);
          $permisos->user_id=$guardar->id;
        }
        $permisos->save();
        Session::flash('mensaje', '¡Admin actualizado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/admins'));
      }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyadmin(Request $request)
    {
      $admin = User::find($request->admin_id);
      $admin->delete();
      Session::flash('mensaje', '!Admin eliminado correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/admins'));
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
