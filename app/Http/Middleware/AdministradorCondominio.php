<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdministradorCondominio
{
    /**
     * Handle an incoming request.
     *
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
		    if ($usuario->condominio_id == null || $usuario->condominio_id==0) {
			    Session::flash('mensaje', 'No tienes permisos para ver esta página');
			    Session::flash('class', 'warning');
			    return redirect()->intended(url('/404'));
		    }
	    }
	    return $next($request);
    }
}
