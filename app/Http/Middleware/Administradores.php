<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;
class Administradores
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
      if ($usuario->role=="superadmin"||$usuario->role=="admin") {

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
