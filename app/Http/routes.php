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

Route::get( '/promo', function () {
	dd( Promocodes::generate( 5 ) );

} );

Route::get( 'mail/{id}', 'Publico\OrdenController@create' );
Route::get( '/', 'Publico\HomeController@index' );
Route::get( '/home', function () {
	return redirect()->intended( url( '/' ) );
} );
Route::get( '/nosotros', function () {
	return view( 'nosotros' );
} );
Route::get( '/contacto', function () {
	return view( 'contacto' );
} );
Route::get( '/clasesdeportivas', function () {
	$clases      = App\Clase::where( 'tipo', 'Deportiva' )->orderBy( 'nombre', 'asc' )->get();
	$zonarequest = 'todas';
	$titulo      = "DEPORTIVAS";

	return view( 'clases', [ 'clases' => $clases, 'zonarequest' => $zonarequest, 'titulo' => $titulo ] );
} );

Route::post( '/clasesdeportivas', function ( Illuminate\Http\Request $request ) {
	$clases      = App\Clase::where( 'tipo', 'Deportiva' )->orderBy( 'nombre', 'asc' )->get();
	$zonarequest = $request->zona;
	$titulo      = "DEPORTIVAS";


	return view( 'clases', [ 'clases' => $clases, 'zonarequest' => $zonarequest, 'titulo' => $titulo ] );
} );
Route::get( '/claseskids', function () {
	$clases      = App\Clase::where( 'tipo', 'Kids' )->orderBy( 'nombre', 'asc' )->get();
	$zonarequest = 'todas';
	$titulo      = "KIDS";

	return view( 'kids', [ 'clases' => $clases, 'zonarequest' => $zonarequest, 'titulo' => $titulo ] );
} );
Route::post( '/claseskids', function ( Illuminate\Http\Request $request ) {
	$clases      = App\Clase::where( 'tipo', 'Kids' )->orderBy( 'nombre', 'asc' )->get();
	$zonarequest = $request->zona;
	$titulo      = "KIDS";


	return view( 'kids', [ 'clases' => $clases, 'zonarequest' => $zonarequest, 'titulo' => $titulo ] );
} );

Route::get( '/clasesculturales', function () {
	$clases      = App\Clase::where( 'tipo', 'Cultural' )->orderBy( 'nombre', 'asc' )->get();
	$zonarequest = 'todas';
	$titulo      = "CULTURALES";

	return view( 'culturales', [ 'clases' => $clases, 'zonarequest' => $zonarequest, 'titulo' => $titulo ] );
} );

Route::post( '/clasesculturales', function ( Illuminate\Http\Request $request ) {
	$clases      = App\Clase::where( 'tipo', 'Cultural' )->orderBy( 'nombre', 'asc' )->get();
	$zonarequest = $request->zona;
	$titulo      = "CULTURALES";

	return view( 'culturales', [ 'clases' => $clases, 'zonarequest' => $zonarequest, 'titulo' => $titulo ] );
} );
Route::get( '/comprar-clases', function () {
	$particulares  = App\Paquete::where( 'tipo', 'A domicilio' )->get();
	$residenciales = App\Paquete::where( 'tipo', 'En condominio' )->get();

	return view( 'comprar-paquetes', [ 'particulares' => $particulares, 'residenciales' => $residenciales ] );
} );

Route::get( '/comprar-paquete/{id}', function ( $id ) {
	$paquete = App\Paquete::find( $id );

	return view( 'cart.cart', [ 'paquete' => $paquete ] );
} );


Route::get( '/busqueda', function () {
	$clases = App\Clase::where( 'nombre', 'like', '%%' )->orderBy( 'nombre', 'asc' )->get();
	$titulo = "RESULTADOS";

	return view( 'busqueda', [ 'clases' => $clases, 'busqueda' => '', 'titulo' => $titulo ] );
} );
Route::post( '/busqueda', function ( Illuminate\Http\Request $request ) {
	$clases = App\Clase::where( 'nombre', 'like', '%' . $request->busqueda . '%' )->orderBy( 'nombre', 'asc' )->get();
	$titulo = "RESULTADOS";
	if ( $clases->isEmpty() ) {
		Illuminate\Support\Facades\Session::flash( 'mensaje', 'No hay resultados disponibles.' );
		Illuminate\Support\Facades\Session::flash( 'class', 'danger' );
	}

	return view( 'busqueda', [ 'clases' => $clases, 'busqueda' => $request->busqueda, 'titulo' => $titulo ] );
} );

Route::get( '/coaches', function () {
	$coaches = App\User::where( 'role', 'instructor' )->where( 'name', '<>', 'FITCOACH' )->orderBy( 'rating', 'desc' )->get();

//$coaches = App\User::where('role', 'instructor')->where('name','<>','FITCOACH')->join('detalles', 'users.id', '=', 'detalles.user_id')->orderBy('detalles.rating', 'desc')->get();

	/*

	  $coaches = App\User::where('role', 'instructor')->where('name','<>','FITCOACH')->whereHas('detalles', function ($query) {
		  $query->where('rating', '<>', 0);
	  })->orderBy('detalles.rating', 'desc')->get();
	  dd($coaches);
	  $detalles=App\Detalle::orderBy('rating', 'desc')->get();
	  $coaches2= new App\User();
	  $cont=0;
	  foreach ($detalles as $detalle) {
		if ($detalle->user->role=="instructor"&&$detalle->user->name!="FITCOACH") {
		  $coaches2[$cont]=$detalle->user();
		}
		$cont++;
	  }
	  dd($coaches2);*/

	return view( 'instructores', [ 'coaches' => $coaches ] );
} );

Route::get( '/eventos', 'Publico\EventosController@index' );
Route::post( '/eventos', 'Publico\EventosController@search' );
Route::get( '/eventos/comprar', 'Publico\EventosController@comprar' );
Route::post( '/eventos/pagar', 'Publico\EventosController@pago' );
Route::get( '/eventos/reservado/{eventoId}', 'Publico\EventosController@reservado' );

Route::get( '/eventos', 'Publico\EventosController@index' );



Route::group( [ 'prefix' => 'admin-condominio', 'namespace' => 'AdminCondominio' , 'middleware' => 'admin.condominio'], function () {
	Route::get( '/', 'MainController@index' );
	Route::post( '/agregar-evento', 'EventoController@crear' );
	Route::put( '/actualizar-evento', 'EventoController@actualizar' );
	Route::delete( '/eliminar-evento', 'EventoController@eliminar' );
	Route::post( '/agregar-grupo', 'GrupoController@store' );
	Route::put( '/actualizar-grupo', 'GrupoController@update' );
	Route::post( '/grupos/agregar-horario', 'HorarioController@crear' );
	Route::delete( '/eliminar-grupo', 'GrupoController@remove' );
	Route::get( '/cancelar/{id}', 'MainController@cancelar' );
	Route::post( '/agregar-mensaje', 'MensajeController@guardar' );
	Route::get('clasesdeinstructor/{coachId}','InstructorController@clases');

});



Route::get( '/buscarcoach', function () {
	$coaches = App\User::where( 'name', 'like', '%%' )->where( 'role', 'instructor' )->get();

	return view( 'instructores', [ 'coaches' => $coaches ] );
} );

Route::post( '/buscarcoach', function ( Illuminate\Http\Request $request ) {
	$coaches = App\User::where( 'name', 'like', '%' . $request->busqueda . '%' )->where( 'role', 'instructor' )->get();

	return view( 'instructores', [ 'coaches' => $coaches ] );
} );

Route::get( '/condominios', 'CondominioController@index' );

Route::get( '/condominios/{name}', 'CondominioController@show' );

Route::get( '/condominios/{name}/{roomId}', 'CondominioController@room' );


Route::get( '/buscarresidencial', function () {
	$condominios = App\Condominio::where( 'identificador', 'like', '%%' )->get();

	return view( 'condominios', [ 'condominios' => $condominios ] );
} );
Route::post( '/buscarresidencial', function ( Illuminate\Http\Request $request ) {
	$condominios = App\Condominio::where( 'identificador', 'like', '%' . $request->busqueda . '%' )->get();

	return view( 'condominios', [ 'condominios' => $condominios ] );
} );


Route::get( '/legales', function ( Illuminate\Http\Request $request ) {
	return view( 'legales', [ 'request' => $request ] );
} );
Route::get( '/quienes-somos', function () {
	return view( 'about' );
} );
Route::get( '/bolsa-de-trabajo', function () {
	return view( 'bolsa' );
} );
Route::post( '/bolsa-de-trabajo', function ( Illuminate\Http\Request $request ) {
	$datos[] = $request;

	if ( $datos[0]->hasFile( 'cv' ) ) {
		$file = $datos[0]->file( 'cv' );
		$name = "cv-" . time() . "." . $file->getClientOriginalExtension();
		$path = base_path( 'uploads/temp/' );
		$file->move( $path, $name );
	}
	$datos[] = $name;
	Mail::send( 'emails.bolsa', [ 'datos' => $datos[0] ], function ( $m ) use ( $datos ) {

		$m->from( $datos[0]->email, $datos[0]->nombre );
		$m->attach( url( '/uploads/temp/' . $datos[1] ), [ 'as' => $datos[1] ] );
		$m->to( 'hmuller@fitcoach.mx', 'FITCOACH México' )->subject( 'Bolsa de trabajo' );
	} );
	Illuminate\Support\Facades\File::delete( $path . $name );
	Illuminate\Support\Facades\Session::flash( 'mensaje', '¡Mensaje enviado!' );
	Illuminate\Support\Facades\Session::flash( 'class', 'success' );

	return redirect()->intended( url( '/bolsa-de-trabajo' ) );
} );

Route::get( '/contacto', function () {
	return view( 'contacto' );
} );

Route::post( '/contacto', function ( Illuminate\Http\Request $request ) {
	$datos = $request;

	Mail::send( 'emails.contacto', [ 'datos' => $datos ], function ( $m ) use ( $datos ) {
		$m->from( $datos->email, $datos->nombre );
		$m->to( 'hmuller@fitcoach.mx', 'FITCOACH México' )->subject( 'Contacto' );
	} );

	Illuminate\Support\Facades\Session::flash( 'mensaje', '¡Mensaje enviado!' );
	Illuminate\Support\Facades\Session::flash( 'class', 'success' );

	return redirect()->intended( url( '/contacto' ) );
} );


Route::post( 'carrito', 'Publico\OrdenController@cartinst' );
Route::get( '/carrito', function () {
	$items = Cart::content();

	return view( 'cart.reservar', [ 'items' => $items ] );
} );
Route::post( 'reservar', 'Publico\OrdenController@reservar' );
Route::get( 'removefromcart/{rowId}', 'Publico\OrdenController@destroy' );
Route::post( 'descuento', 'CuponeraController@store' );


// Authentication routes...
Route::get( 'entrar', 'Auth\AuthController@getLogin' );
Route::post( 'userExist', 'UserController@userExist' );
Route::post( 'entrar', 'Auth\AuthController@postLogin' );
Route::get( 'salir', 'Auth\AuthController@getLogout' );
// Registration routes...
Route::get( 'registro', 'Auth\AuthController@getRegister' );
Route::post( 'registro', 'Auth\AuthController@postRegister' );

// Password reset link request routes...
Route::get( 'password/email', 'Auth\PasswordController@getEmail' );
Route::post( 'password/email', 'Auth\PasswordController@postEmail' );

// Password reset routes...
Route::get( 'password/reset/{token}/{email}', 'Auth\PasswordController@getReset' );
Route::post( 'password/reset', 'Auth\PasswordController@postReset' );


Route::post( 'traerdireccion', 'DireccionController@traerdireccion' );

Route::put( 'actualizar-contraseña', 'UserController@updatePassword' );

// Zonas seguras
Route::group( [ 'middleware' => 'administradores' ], function () {
	Route::get( '/admin', function () {
		$user = App\User::find( Auth::user()->id );

		return view( 'admin.admin', [ 'user' => $user ] );
	} );
	Route::get( '/admins/condominio/{condominioId}', 'Admin\CondominioAdminController@admin' );
	Route::get( '/admins', 'Admin\UserController@index' );
	Route::post( '/admins', 'Admin\UserController@search' );
	Route::post( 'agregar-admin', 'Admin\UserController@storeadmin' );
	Route::put( 'actualizar-admin', 'Admin\UserController@updateadmin' );
	Route::delete( 'eliminar-admin', 'Admin\UserController@destroyadmin' );


	Route::get( '/residenciales', function () {
		$condominios = App\Condominio::all();

		return view( 'admin.condominios', [ 'condominios' => $condominios ] );
	} );
	Route::post( '/condominios', function ( Illuminate\Http\Request $request ) {
		$condominios = App\Condominio::where( 'identificador', 'like', '%' . $request->busqueda . '%' )->get();

		return view( 'admin.condominios', [ 'condominios' => $condominios ] );
	} );
	Route::post( 'agregar-condominio', 'CondominioController@store' );
	Route::put( 'actualizar-condominio', 'CondominioController@update' );
	Route::delete( 'eliminar-condominio', 'CondominioController@destroy' );

	Route::get( '/clases', function () {
		$clases = App\Clase::all();

		return view( 'admin.clases', [ 'clases' => $clases ] );
	} );
	Route::post( 'agregar-clase', 'ClaseController@store' );
	Route::put( 'actualizar-clase', 'ClaseController@update' );
	Route::delete( 'eliminar-clase', 'ClaseController@destroy' );

	Route::get( '/grupos', function () {
		$grupos      = App\Grupo::all();
		$rooms       = App\Room::all();
		$coaches     = App\User::where( 'role', 'instructor' )->get();
		$clases      = App\Clase::all();
		$condominios = App\Condominio::all();
		$horarios    = App\Horario::where( 'grupo_id', '<>', '' )->get();

		return view( 'admin.grupos', [ 'grupos'      => $grupos,
		                               'rooms'       => $rooms,
		                               'coaches'     => $coaches,
		                               'clases'      => $clases,
		                               'condominios' => $condominios,
		                               'horarios'    => $horarios
		] );
	} );
	Route::post( '/grupos', function ( Illuminate\Http\Request $request ) {
		$grupos      = App\Grupo::all();
		$rooms       = App\Room::all();
		$coaches     = App\User::where( 'role', 'instructor' )->get();
		$clases      = App\Clase::all();
		$condominios = App\Condominio::where( 'identificador', 'like', '%' . $request->busqueda . '%' )->get();
		$eventos     = App\Grupo::where( 'tipo', 'Evento' )->get();

		return view( 'admin.residenciales', [ 'grupos'      => $grupos,
		                                      'rooms'       => $rooms,
		                                      'coaches'     => $coaches,
		                                      'clases'      => $clases,
		                                      'condominios' => $condominios,
		                                      'eventos'     => $eventos
		] );
	} );
	Route::post( 'agregar-grupo', 'ResidencialController@store' );
	Route::put( 'actualizar-grupo', 'ResidencialController@update' );
	Route::delete( 'eliminar-grupo', 'ResidencialController@destroy' );

	Route::post( 'agregar-horariogrupo', 'ResidencialController@store2' );
	Route::put( 'actualizar-horariogrupo', 'ResidencialController@update2' );
	Route::delete( 'eliminar-horariogrupo', 'ResidencialController@destroy2' );

	Route::get( '/eventos-admin', 'Admin\EventoController@index' );
	Route::post( '/agregar-evento', 'ResidencialController@storeevento' );
	Route::put( '/actualizar-evento', 'ResidencialController@updateevento' );
	Route::delete( '/eliminar-evento', 'ResidencialController@destroyevento' );


	Route::get( '/slides', function () {
		if ( Auth::guest() ) {
			return redirect()->intended( url( '/entrar' ) );
		} else {
			$slides = App\Slider::orderBy( 'order', 'asc' )->get();

			return view( 'admin.slide', [ 'slides' => $slides ] );
		}
	} );

	Route::get( '/zonas', function () {

		$zonas = App\Zona::all();

		return view( 'admin.zonas', [ 'zonas' => $zonas ] );

	} );

	Route::get( '/clientes', function () {
		$usuarios = App\User::where( 'role', 'usuario' )->get();

		return view( 'admin.clientes', [ 'usuarios' => $usuarios ] );
	} );

	Route::post( 'agregar-slide', 'SliderController@store' );
	Route::any( 'actualizar-slide/{id}', 'SliderController@update' );
	Route::any( 'eliminar-slide/{id}', 'SliderController@destroy' );

	Route::post( 'agregar-zona', 'ZonaController@store' );
	Route::any( 'actualizar-zona/{id}', 'ZonaController@update' );
	Route::any( 'eliminar-zona/{id}', 'ZonaController@destroy' );


	Route::delete( 'eliminar-cliente', 'UserController@destroycliente' );

	Route::get( '/condominio-admins', 'Admin\CondominioAdminController@show' );
	Route::post( '/agregar-condominio-admin', 'Admin\CondominioAdminController@create' );
	Route::put( 'actualizar-condominio-admin', 'Admin\CondominioAdminController@update' );
	Route::delete( 'eliminar-condominio-admin', 'Admin\CondominioAdminController@destroy' );


	Route::get( '/coaches-admin', 'Admin\CoachAdmin@show' );
	Route::post( '/coaches-admin', 'Admin\CoachAdmin@search' );
	Route::post( 'agregar-coach', 'Admin\CoachAdmin@storecoach' );
	Route::put( 'actualizar-coach', 'Admin\CoachAdmin@updatecoach' );
	Route::delete( 'eliminar-coach', 'Admin\CoachAdmin@destroycoach' );


	Route::get( 'ventas', 'Publico\OrdenController@ventas' );
	Route::post( 'ventas', 'Publico\OrdenController@ventaspost' );
	Route::get( 'verinvoice/{id}', 'Publico\OrdenController@verinvoice' );
	Route::get( 'printinvoice/{id}', 'Publico\OrdenController@invoice' );
	Route::get( 'nomina', 'Publico\OrdenController@nomina' );
	Route::get( '/reportes', 'Reports\ReportController@index' );
	Route::post( '/crear-reporte', 'Reports\ReportController@create' );
	Route::post( 'pagar', 'Publico\OrdenController@pago' );
	Route::get( 'historialpagos/{id}', 'Publico\OrdenController@historialpagos' );
	Route::get( 'clasesvista', 'Admin\ClaseController@clasesvista' );
	Route::post( 'clasesvista', 'Admin\ClaseController@clasesvistapost' );

	Route::get( 'cupones', 'CuponController@index' );
	Route::post( 'agregar-cupon', 'CuponController@store' );
	Route::put( 'actualizar-cupon', 'CuponController@update' );
	Route::delete( 'eliminar-cupon', 'CuponController@destroy' );
	Route::put( 'comentarios', 'Publico\OrdenController@comentarios' );
	Route::post( 'abonar', 'Publico\OrdenController@abonar' );
	Route::post( 'cancelar', 'Publico\OrdenController@cancelar' );
	Route::get( 'printlist/{id}', 'ResidencialController@printlist' );
	Route::get( 'printeventlist/{id}', 'ResidencialController@printlistevent' );
	Route::get( 'printgroups/{id}', 'ResidencialController@printgroups' );

	Route::post( 'tokenplus', 'Publico\OrdenController@tokenplus' );
	Route::post( 'tokenminus', 'Publico\OrdenController@tokenminus' );


	Route::get( '/rooms', function () {
		$rooms = App\Room::all();

		return view( 'admin.rooms', [ 'rooms' => $rooms ] );
	} );
	Route::post( 'agregar-room', 'RoomController@store' );
	Route::put( 'actualizar-room', 'RoomController@update' );
	Route::delete( 'eliminar-room', 'RoomController@destroy' );

} );


Route::group( [ 'middleware' => 'usuarios' ], function () {
	Route::get( '/perfil', function () {
		$user = App\User::find( Auth::user()->id );
		if(isset($user->condominio_id)){
			return redirect('/admin-condominio');
		}else{
			return view( 'perfil', [ 'user' => $user ] );
		}
	} );



	Route::post( 'actualizar-perfil', 'DetalleController@store' );
	Route::put( 'actualizar-perfil', 'DetalleController@update' );


	Route::post( 'agregar-direccion', 'DireccionController@store' );
	Route::put( 'actualizar-direccion', 'DireccionController@update' );
	Route::delete( 'eliminar-direccion', 'DireccionController@destroy' );

	Route::post( 'agregar-tarjeta', 'TarjetaController@store' );
	Route::put( 'actualizar-tarjeta', 'TarjetaController@update' );
	Route::delete( 'eliminar-tarjeta', 'TarjetaController@destroy' );

	Route::put( 'cancelar-orden', 'Publico\OrdenController@update' );


	Route::post( 'cargartarjeta', 'Publico\OrdenController@cargartarjeta' );

	Route::post( 'cargo', 'Publico\OrdenController@cargo' );

	Route::get( '/recibo/{id}', 'Publico\OrdenController@receipt' );

	Route::get( '/completa', 'Publico\OrdenController@complete' );
	Route::get( '/reservada', 'Publico\OrdenController@reservada' );
	Route::get( '/probarcomplete', 'Publico\OrdenController@probarcomplete' );

	Route::post( 'rate', 'RatingController@store' );

} );


Route::group( [ 'middleware' => 'instructores' ], function () {
	Route::get( '/perfilinstructor', 'Instructor\PerfilInstructor@index' );
	Route::get( '/iniciar/{id}', 'Instructor\PerfilInstructor@iniciar' );

	Route::post( 'actualizar-perfilcoach', 'DetalleController@storeinst' );
	Route::put( 'actualizar-perfilcoach', 'DetalleController@updateinst' );

	Route::post( 'agregar-horario', 'ParticularController@store' );
	Route::put( 'actualizar-horario', 'ParticularController@update' );
	Route::delete( 'eliminar-horario', 'ParticularController@destroy' );

	Route::post( 'actualizar-bancarios', 'BancariosController@store' );
	Route::put( 'actualizar-bancarios', 'BancariosController@update' );


	Route::post( 'planear-clase', 'PlanController@store' );
	Route::put( 'planear-clase', 'PlanController@update' );

	Route::post( 'terminar-orden', 'Instructor\PerfilInstructor@terminarClase' );
	Route::get( '/iniciar/{id}', 'Instructor\PerfilInstructor@iniciarClase' );
	Route::post('/crear-invitado', 'Instructor\PerfilInstructor@agregarInvitado');


	Route::post( 'agregar-libre', 'ClaseController@libre' );
	Route::delete( 'eliminar-libre', 'ClaseController@destroylibre' );


	Route::post( 'subir-documentacion', 'BancariosController@store2' );
	Route::put( 'subir-documentacion', 'BancariosController@update2' );


} );
Route::get( 'listainscritos/{id}', 'ResidencialController@printlist' );
Route::get( 'busquedaporcelular', 'Publico\HomeController@busqueda' );

