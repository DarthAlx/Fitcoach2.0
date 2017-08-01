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
Route::get('/', function () {
  $sliders = App\Slider::orderBy('order', 'asc')->get();
  return view('inicio', ['sliders'=>$sliders]) ;
});
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
Route::get('/instructores', function () {
  $coaches = App\User::where('role', 'instructor')->get();
    return view('instructores', ['coaches'=>$coaches]);
});
Route::get('/condominios', function () {
  $condominios = App\Condominio::all();
    return view('condominios', ['condominios'=>$condominios]);
});
Route::get('/clasesdeportivas', function () {
  $clases = App\Clase::where('tipo', 'Deportiva')->get();
    return view('clases', ['clases'=>$clases]);
});

Route::post('carrito', 'OrdenController@cartinst');

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
});


Route::group(['middleware' => 'instructores'], function(){

});
