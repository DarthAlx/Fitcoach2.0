<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
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
      $usuario=User::find(Auth::user()->id);
      if ($usuario->role!="superadmin") {
        Session::flash('mensaje', 'No tienes permisos para ver esta página');
        Session::flash('class', 'warning');
        return redirect()->intended(url('/entrar'));
      }
        return $next($request);
    }
}
