<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 24/09/18
 * Time: 09:39 PM
 */

namespace App\Http\Controllers\Admin;


use App\Condominio;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdministradorCondominioRequest;
use App\Http\Requests\Request;
use App\User;
use Illuminate\Support\Facades\Session;

class CondominioAdminController extends Controller
{
    public function show()
    {
        $usuarios = User::has('condominioAdmin')->get();
        $condominios = Condominio::all();
        return view('admin.condominio_admins', [
            'usuarios' => $usuarios,
            'condominios' => $condominios
        ]);
    }

    public function create(CreateAdministradorCondominioRequest $request)
    {

        $guardar = new User($request->all());
        $guardar->password = bcrypt($request->password);
        if (isset($request->editor)) {
            $guardar->editor = 1;
        } else {
            $guardar->editor = 0;
        }
        $guardar->save();
        Session::flash('mensaje', '¡Usuario guardado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/condominio-admins'));
    }

    public function update(CreateAdministradorCondominioRequest $request)
    {
        $guardar = User::find($request->admin_id);
        $guardar->name = $request->name;
        $guardar->email = $request->email;
        $guardar->dob = $request->dob;
        $guardar->tel = $request->tel;
        $guardar->genero = $request->genero;
        if ($request->has('condominio_id')) {
            $guardar->condominio_id = $request->condominio_id;
        }
        if ($request->password) {
            $guardar->password = bcrypt($request->password);
        }
        $guardar->save();
        Session::flash('mensaje', '¡Usuario actualizado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/condominio-admins'));
    }

    public function destroy(Request $request)
    {
        $guardar = User::find($request->admin_id);
        $guardar->email = "banned" . "-" . time();
        $guardar->role = "banned";
        $guardar->password = bcrypt("banhammer");
        $guardar->save();
        Session::flash('mensaje', '¡Usuario eliminado correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/condominio-admins'));
    }
}