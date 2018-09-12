<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 11/09/18
 * Time: 04:32 PM
 */

namespace App\Http\Controllers\Admin;


use App\Condominio;
use App\Detalle;
use App\Http\Controllers\Controller;
use App\Modulo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{

    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $usuarios = User::where('role', 'admin')->get();
        $modulos = Modulo::all();
        $condominios = Condominio::all();
        return view('admin.usuarios')
            ->with('condominios',$condominios)
            ->with('usuarios', $usuarios)
            ->with('modulos', $modulos);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function search(Request $request)
    {
        $usuarios = User::where('name', 'like', '%' . $request->busqueda . '%')->where('role', 'admin')->get();
        $modulos = Modulo::all();
        $condominios = Condominio::all();
        return view('admin.usuarios')
            ->with('condominios',$condominios)
            ->with('usuarios', $usuarios)
            ->with('modulos', $modulos);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            $guardar->password=bcrypt($request->password);
            $guardar->role = 'admin';
            //editor
            if (isset($request->editor)) {
                $guardar->editor=1;
            }
            else{
                $guardar->editor=0;
            }
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
     * @param array $data
     * @return mixed
     */
    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'password' => 'confirmed|min:6'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            if($request->has('condominio_id')){
                $guardar->condominio_id=$request->condominio_id;
            }
            if ($request->password) {
                $guardar->password=bcrypt($request->password);
            }
//editor
            if (isset($request->editor)) {
                $guardar->editor=1;
            }
            else{
                $guardar->editor=0;
            }
            $guardar->save();
            if($guardar->detalles) {
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
            }

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

}