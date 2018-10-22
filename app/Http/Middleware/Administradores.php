<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Modulo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
class Administradores
{
    /**
     * Handle an incoming request.
     *z
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (Auth::guest()) {
        return redirect()->intended(url('/404'));
      }
      else {
      $usuario=User::find(Auth::user()->id);
      if ($usuario->role=="superadmin"||$usuario->role=="admin") {
        $modulos=Modulo::all();
        $modulosarray=array();
        foreach ($modulos as $modulo) {
          $modulosarray[]=$modulo->nombre;
        }
        if(isset($usuario->detalles)){
	        $permisos=explode(",",$usuario->detalles->permisos);
        }else{
        	$permisos = [];
        }
        $urlactual = str_replace(url()."/", "", $request->url());
        if (in_array($urlactual, $modulosarray)) {
          if (in_array($urlactual, $permisos)||$usuario->role=="superadmin") {

          }
          else {
            Session::flash('mensaje', 'No tienes permisos para ver esta página');
            Session::flash('class', 'warning');
            return redirect()->intended(url('/404'));
          }
        }
      }
      else {
        Session::flash('mensaje', 'No tienes permisos para ver esta página');
        Session::flash('class', 'warning');
        return redirect()->intended(url('/404'));
      }
      }
        return $next($request);
    }
}
