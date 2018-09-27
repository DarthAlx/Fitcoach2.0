<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 24/09/18
 * Time: 08:32 PM
 */

namespace App\Http\Controllers\Admin;


use App\Detalle;
use App\Http\Controllers\Controller;
use App\Particular;
use App\Residencial;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CoachAdmin extends Controller
{

    public function show()
    {
        $usuarios = User::with('bancarios')->where('role', 'instructor')->get();
        return view('admin.coaches', ['usuarios' => $usuarios]);
    }

    public function search(Request $request)
    {
        $usuarios = User::where('name', 'like', '%' . $request->busqueda . '%')->where('role', 'instructor')->get();
        return view('admin.coaches', ['usuarios' => $usuarios]);
    }

    public function storecoach(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        } else {
            $guardar = new User($request->all());
            $guardar->role = "instructor";
            $guardar->code = str_random(6);
            $guardar->password = bcrypt($request->password);

            $permisos = new Detalle();

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                if ($file->getClientOriginalExtension() == "jpg" || $file->getClientOriginalExtension() == "png") {
                    $name = Auth::user()->id . "-" . time() . "." . $file->getClientOriginalExtension();
                    $path = base_path('uploads/avatars/');
                    $file->move($path, $name);
                    $permisos->photo = $name;
                } else {
                    Session::flash('mensaje', 'El archivo no es una imagen valida.');
                    Session::flash('class', 'danger');
                    return redirect()->intended(url('/coaches-admin'))->withInput();
                }

            } else {
                Session::flash('mensaje', 'El archivo no es una imagen valida.');
                Session::flash('class', 'danger');
                return redirect()->intended(url('/coaches-admin'))->withInput();
            }


            if ($request->clases) {
                $guardar->save();
                $permisos->clases = implode(",", $request->clases);
                $permisos->user_id = $guardar->id;
            } else {
                Session::flash('mensaje', 'El coach debe tener por lo menos una clase asignada.');
                Session::flash('class', 'danger');
                return redirect()->intended(url('/coaches-admin'))->withInput();
            }

            $permisos->save();
            $datos = $request;
            Mail::send('emails.usuario', ['datos' => $datos], function ($m) use ($datos) {
                $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
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
        } else {
            $guardar = User::find($request->admin_id);
            $guardar->name = $request->name;
            $guardar->email = $request->email;
            $guardar->dob = $request->dob;
            $guardar->tel = $request->tel;
            $guardar->genero = $request->genero;
            if ($request->password) {
                $guardar->password = bcrypt($request->password);
            }

            $permisos = Detalle::find($guardar->detalles->id);
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                if ($file->getClientOriginalExtension() == "jpg" || $file->getClientOriginalExtension() == "png") {
                    $name = Auth::user()->id . "-" . time() . "." . $file->getClientOriginalExtension();
                    $path = base_path('uploads/avatars/');
                    $file->move($path, $name);
                    if ($permisos->photo != 'dummy.png') {
                        File::delete($path . $permisos->photo);
                    }
                    $permisos->photo = $name;
                } else {
                    Session::flash('mensaje', 'El archivo no es una imagen valida.');
                    Session::flash('class', 'danger');
                    return redirect()->intended(url('/coaches-admin'))->withInput();
                }

            }

            if ($request->clases) {
                $permisos->clases = implode(",", $request->clases);
                $permisos->user_id = $guardar->id;
            } else {
                $permisos->clases = $request->clases;
                $permisos->user_id = $guardar->id;
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

        $guardar->email = "banned" . "-" . time();
        $guardar->role = "banned";
        $guardar->password = bcrypt("banhammer");

        $guardar->save();

        $particulares = Particular::where('user_id', $request->admin_id)->get();

        $residenciales = Residencial::where('user_id', $request->admin_id)->get();
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

}