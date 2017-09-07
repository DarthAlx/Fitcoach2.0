<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Rutas publicas
Route::get('mail/{id}', 'OrdenController@create');
Route::get('/', function () {
  $sliders = App\Slider::orderBy('order', 'asc')->get();
  return view('inicio', ['sliders'=>$sliders]) ;
});
Route::get('ventas', 'OrdenController@ventas');
Route::post('ventas', 'OrdenController@ventaspost');
Route::get('/nosotros', function () {
    return view('nosotros');
});
Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/clasesdeportivas', function () {
  $clases = App\Clases::where('tipo', 'Deportiva')->get();
    return view('clasesdeportivas', ['clases'=>$clases]);
});
Route::get('/aviso', function () {
    return view('aviso');
});
Route::get('/bolsa-de-trabajo', function () {
    return view('bolsa');
});
Route::post('/bolsa-de-trabajo', function (Illuminate\Http\Request $request) {
    $datos[]=$request;

    if ($datos[0]->hasFile('cv')) {
      $file = $datos[0]->file('cv');
      $name = "cv-". time(). "." . $file->getClientOriginalExtension();
      $path = base_path('uploads/temp/');
      $file-> move($path, $name);
    }
    $datos[]=$name;
    Mail::send('emails.bolsa', ['datos'=>$datos[0]], function ($m) use ($datos) {

        $m->from($datos[0]->email, $datos[0]->nombre);
        $m->attach(url('/uploads/temp/'.$datos[1]), ['as' => $datos[1]]);
        $m->to('alx.morales@outlook.com', 'FITCOACH México')->subject('Bolsa de trabajo');
    });
    Illuminate\Support\Facades\File::delete($path . $name);
    Illuminate\Support\Facades\Session::flash('mensaje', '!Mensaje enviado!');
    Illuminate\Support\Facades\Session::flash('class', 'success');
    return redirect()->intended(url('/bolsa-de-trabajo'));
});
Route::get('/coaches', function () {
  $coaches = App\User::where('role', 'instructor')->get();
    return view('instructores', ['coaches'=>$coaches]);
});
Route::get('/residenciales', function () {
  $condominios = App\Condominio::all();
    return view('condominios', ['condominios'=>$condominios]);
});
Route::get('/clasesdeportivas', function () {
  $clases = App\Clase::where('tipo', 'Deportiva')->get();
    return view('clases', ['clases'=>$clases]);
});

Route::post('carrito', 'OrdenController@cartinst');
Route::get('/carrito', function () {
  $items=Cart::content();
  return view('cart.cart',['items'=>$items]);
});



// Authentication routes...
Route::get('entrar', 'Auth\AuthController@getLogin');
Route::post('userExist', 'UserController@userExist');
Route::post('entrar', 'Auth\AuthController@postLogin');
Route::get('salir', 'Auth\AuthController@getLogout');
// Registration routes...
Route::get('registro', 'Auth\AuthController@getRegister');
Route::post('registro', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}/{email}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');






// Zonas seguras
Route::group(['middleware' => 'administradores'], function(){
  Route::get('/admin', function () {
    $user = App\User::find(Auth::user()->id);
    return view('admin.admin', ['user'=>$user]) ;
  });
  Route::get('/admins', function () {
    $usuarios = App\User::where('role', 'admin')->get();
    $modulos = App\Modulo::all();
      return view('admin.usuarios', ['usuarios'=>$usuarios, 'modulos'=>$modulos]);
  });
  Route::get('/condominios', function () {
    $condominios = App\Condominio::all();
      return view('admin.condominios', ['condominios'=>$condominios]);
  });
  Route::post('agregar-condominio', 'CondominioController@store');
  Route::put('actualizar-condominio', 'CondominioController@update');
  Route::delete('eliminar-condominio', 'CondominioController@destroy');

  Route::get('/clases', function () {
    $clases = App\Clase::all();
      return view('admin.clases', ['clases'=>$clases]);
  });
  Route::post('agregar-clase', 'ClaseController@store');
  Route::put('actualizar-clase', 'ClaseController@update');
  Route::delete('eliminar-clase', 'ClaseController@destroy');

  Route::get('/grupos', function () {
    $grupos = App\Residencial::all();
    $coaches = App\User::where('role', 'instructor')->get();
    $clases = App\Clase::all();
    $condominios = App\Condominio::all();
      return view('admin.residenciales', ['grupos'=>$grupos, 'coaches'=>$coaches, 'clases'=>$clases, 'condominios'=>$condominios]);
  });
  Route::post('agregar-grupo', 'ResidencialController@store');
  Route::put('actualizar-grupo', 'ResidencialController@update');
  Route::delete('eliminar-grupo', 'ResidencialController@destroy');

  Route::post('agregar-admin', 'UserController@storeadmin');
  Route::put('actualizar-admin', 'UserController@updateadmin');
  Route::delete('eliminar-admin', 'UserController@destroyadmin');
});


Route::group(['middleware' => 'usuarios'], function(){
  Route::get('/perfil', function () {
    $user = App\User::find(Auth::user()->id);
    return view('perfil', ['user'=>$user]) ;
  });
  Route::post('actualizar-perfil', 'DetalleController@store');
  Route::put('actualizar-perfil', 'DetalleController@update');
  Route::put('actualizar-contraseña', 'UserController@updatePassword');

  Route::post('agregar-direccion', 'DireccionController@store');
  Route::put('actualizar-direccion', 'DireccionController@update');
  Route::delete('eliminar-direccion', 'DireccionController@destroy');

  Route::post('agregar-tarjeta', 'TarjetaController@store');
  Route::put('actualizar-tarjeta', 'TarjetaController@update');
  Route::delete('eliminar-tarjeta', 'TarjetaController@destroy');

  Route::put('cancelar-orden', 'OrdenController@update');
  Route::get('removefromcart/{id}', 'OrdenController@destroy');

  Route::post('cargartarjeta', 'OrdenController@cargartarjeta');

  Route::post('cargo', 'OrdenController@cargo');

  Route::get('/recibo/{id}', 'OrdenController@receipt');

});


Route::group(['middleware' => 'instructores'], function(){
  Route::get('/perfilinstructor', function () {
    $user = App\User::find(Auth::user()->id);
    return view('perfilinstructor', ['user'=>$user]) ;
  });
  Route::post('actualizar-perfil', 'DetalleController@storeinst');
  Route::put('actualizar-perfil', 'DetalleController@updateinst');
  Route::put('actualizar-contraseña', 'UserController@updatePassword');
  Route::post('agregar-horario', 'ParticularController@store');
  Route::put('actualizar-horario', 'ParticularController@update');
  Route::delete('eliminar-horario', 'ParticularController@destroy');

  Route::post('actualizar-bancarios', 'BancariosController@store');
  Route::put('actualizar-bancarios', 'BancariosController@update');
});
