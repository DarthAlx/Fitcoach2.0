<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Detalle;
use App\Particular;
use App\Residencial;
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
          Session::flash('mensaje', '¡Usuario guardado!');
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

        $guardar->save();
        $permisos = Detalle::find($guardar->detalles->id);


          if ($request->permisos) {
            $permisos->permisos=implode(",", $request->permisos);
            $permisos->user_id=$guardar->id;
          }
          else {
            $permisos->permisos=$request->permisos;
            $permisos->user_id=$guardar->id;
          }



        $permisos->save();
        Session::flash('mensaje', '¡Usuario actualizado!');
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
      $guardar = User::find($request->admin_id);

      $guardar->email="banned". "-". time();
      $guardar->role="banned";
      $guardar->password=bcrypt("banhammer");

      $guardar->save();
      Session::flash('mensaje', '¡Usuario eliminado correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/admins'));
    }









    public function storecoach(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else {
          $guardar = new User($request->all());
          $guardar->role="instructor";
          $guardar->password=bcrypt($request->password);

          $permisos = new Detalle();

          if ($request->hasFile('photo')) {
          $file = $request->file('photo');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
            $name = Auth::user()->id . "-". time()."." . $file->getClientOriginalExtension();
            $path = base_path('uploads/avatars/');
            $file-> move($path, $name);
            $permisos->photo = $name;
            }


          else{
            Session::flash('mensaje', 'El archivo no es una imagen valida.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/coaches-admin'))->withInput();
          }

        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/coaches-admin'))->withInput();
        }


            if ($request->clases) {
              $guardar->save();
              $permisos->clases=implode(",", $request->clases);
              $permisos->user_id=$guardar->id;
            }
            else {
              Session::flash('mensaje', 'El coach debe tener por lo menos una clase asignada.');
              Session::flash('class', 'danger');
              return redirect()->intended(url('/coaches-admin'))->withInput();
            }

          $permisos->save();
          $datos=$request;
            Mail::send('emails.usuario', ['datos'=>$datos], function ($m) use ($datos) {
                $m->from('noreply@fitcoach.mx', 'FITCOACH México');
                $m->to($datos->email, $datos->name)->subject('¡Accesos FITCOACH!');
            });
          Session::flash('mensaje', '¡Usuario guardado!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/coaches-admin'));
        }
    }
public function updatecoach(Request $request)
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

        $permisos = Detalle::find($guardar->detalles->id);
        if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
          $name = Auth::user()->id . "-". time()."." . $file->getClientOriginalExtension();
          $path = base_path('uploads/avatars/');
          $file-> move($path, $name);
          if ($permisos->photo !='dummy.png') {
                File::delete($path . $permisos->photo);
              }
          $permisos->photo = $name;
          }


        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/coaches-admin'))->withInput();
        }

      }
      else{
        Session::flash('mensaje', 'El archivo no es una imagen valida.');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/coaches-admin'))->withInput();
      }
          if ($request->clases) {
            $permisos->clases=implode(",", $request->clases);
            $permisos->user_id=$guardar->id;
          }
          else {
            $permisos->clases=$request->clases;
            $permisos->user_id=$guardar->id;
          }




          $guardar->save();
        $permisos->save();
        Session::flash('mensaje', '¡Usuario actualizado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/coaches-admin'));
      }
    }
public function destroycoach(Request $request)
    {

      $guardar = User::find($request->admin_id);

      $guardar->email="banned". "-". time();
      $guardar->role="banned";
      $guardar->password=bcrypt("banhammer");

      $guardar->save();

      $particulares=Particular::where('user_id', $request->admin_id)->get();

      $residenciales=Residencial::where('user_id', $request->admin_id)->get();
      if ($particulares) {
        foreach ($particulares as $particular) {
          $particular->delete();
        }
      }
      if ($residenciales) {
        foreach ($residenciales as $residencial) {
          $residencial->delete();
        }
      }


      Session::flash('mensaje', '¡Usuario eliminado correctamente!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/coaches-admin'));
    }



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
