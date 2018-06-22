<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Cart;
use Illuminate\Support\Facades\Lang;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     public function userExist(Request $request)
     {

           ?>
           <p>hola</p>
           <?php

     }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|confirmed|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::login($this->create($request->all()));
        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => ucfirst($data['name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'dob' => $data['dob'],
            'tel' => $data['tel'],
            'genero' => $data['genero']
        ]);



    }

    public function loginPath()
    {
        return url('/');
    }
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'Los datos no coinciden.';
    }

    public function redirectPath()
    {
      $usuario = User::find(Auth::user()->id);
      $usuario->acceso=date('Y-m-d');
      $usuario->save();
      if (Auth::user()->role=="superadmin" || Auth::user()->role=="admin") {
        return url('/admin');
      }
      if (Auth::user()->role=="instructor") {
        return url('/perfilinstructor');
      }
      else {
        if (Cart::content()->count()>0){
          return url('/carrito');
        }
        else {
          return url('/perfil');
        }

      }


    }



}
