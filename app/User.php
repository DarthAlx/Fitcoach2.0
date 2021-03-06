<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Log;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;


    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'dob',
        'tel',
        'genero',
        'rating',
        'acceso',
        'code',
        'referencia',
        'editor',
        'condominio_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function detalles()
    {
        return $this->hasOne('App\Detalle');
    }

    public function direcciones()
    {
        return $this->hasMany('App\Direccion');
    }

    public function tarjetas()
    {
        return $this->hasMany('App\Tarjeta');
    }

    public function horarios()
    {
        return $this->hasMany('App\Horario');
    }

    public function residenciales()
    {
        return $this->hasMany('App\Horario');
    }

    public function ordenes()
    {
        return $this->hasMany('App\Orden');
    }

    public function bancarios()
    {
        return $this->hasOne('App\Bancarios');
    }



    public function rate()
    {
        return $this->hasMany('App\Rating');
    }

    public function abonos()
    {
        return $this->hasMany('App\Abono')->where('realizado',false);
    }

    public function cupon()
    {
        return $this->hasOne('App\Cupon');
    }

    public function paquetes()
    {
        return $this->hasMany('App\PaqueteComprado');
    }

    public function reservaciones()
    {
        return $this->hasMany('App\Reservacion');
    }

    public function grupo()
    {
        return $this->hasMany('App\Grupo');
    }

    public function libres()
    {
        return $this->hasMany('App\Libres');
    }

    public function documentacion()
    {
        return $this->hasOne('App\Documentacion');
    }

    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }

    public function nomina()
    {
        $pagos = collect(Pago::where('user_id',$this->attributes['id'])->get());
	    $abonos=Abono::with('reservacion')
	                ->with('reservacion.horario')
	                ->with('reservacion.horario.clase')
	                ->where('realizado',true)
	                ->where('user_id',$this->attributes['id'])
	                ->get();
	    $collection = collect($pagos)->merge($abonos)->sortByDate('created_at', false);

        Log::debug('this is payments',['pagos'=>$collection]);
        return $collection;
    }

    public function paquetesDisponiblesDomicilio()
    {
        $now = Carbon::now();

        $sum = PaqueteComprado::where('user_id', $this->attributes['id'])
            ->where(function ($query) use ($now) {
                $query->where('expiracion', '>', $now->toDateString());
                $query->orWhere('expiracion', '=', null);
            })
            ->where('tipo', 'A domicilio')
            ->sum('disponibles');
        if ($sum > 0) {
            return $sum;
        } else {
            return 0;
        }
    }

    public function paquetesDisponiblesCondominio()
    {
        $now = Carbon::now();

        $sum = PaqueteComprado::where('user_id', $this->attributes['id'])
            ->where(function ($query) use ($now) {
                $query->where('expiracion', '>', $now->toDateString());
                $query->orWhere('expiracion', '=', null);
            })
            ->where('tipo', 'En condominio')
            ->sum('disponibles');
        if ($sum > 0) {
            return $sum;
        } else {
            return 0;
        }
    }

    public function paquetesUsadosDomicilio()
    {
        $now = Carbon::now();

        return PaqueteComprado::where('user_id', $this->attributes['id'])
            ->where(function ($query) use ($now) {
                $query->where('expiracion', '>', $now->toDateString());
                $query->orWhere('expiracion', '=', null);
            })
            ->where('tipo', 'A domicilio')
            ->where('disponibles', '=', '0')
            ->count('id');

    }

    public function paquetesporVencerDomicilio()
    {
        $now = Carbon::now();

        $sum = PaqueteComprado::where('user_id', $this->attributes['id'])
            ->where(function ($query) use ($now) {
                $query->where('expiracion', '>', $now->toDateString());
                $query->orWhere('expiracion', '=', null);
            })
            ->where('tipo', 'A domicilio')
            ->sum('disponibles');
        if ($sum > 0) {
            return $sum;
        } else {
            return 0;
        }
    }

    public function paquetesVencidosDomicilio()
    {
        $now = Carbon::now();

        $sum = PaqueteComprado::where('user_id', $this->attributes['id'])
            ->where(function ($query) use ($now) {
                $query->where('expiracion', '<', $now->toDateString());
            })
            ->where('disponibles', '>', '0')
            ->where('tipo', 'A domicilio')
            ->sum('disponibles');
        if ($sum > 0) {
            return $sum;
        } else {
            return 0;
        }
    }

    public function paquetesUsadosCondominio()
    {
        $now = Carbon::now();

        $sum = PaqueteComprado::where('user_id', $this->attributes['id'])
            ->where(function ($query) use ($now) {
                $query->where('expiracion', '>', $now->toDateString());
                $query->orWhere('expiracion', '=', null);
            })
            ->where('tipo', 'En condominio')
            ->count('id');
        if ($sum > 0) {
            return $sum;
        } else {
            return 0;
        }
    }

    public function paquetesporVencerCondominio()
    {
        $now = Carbon::now();

        $sum = PaqueteComprado::where('user_id', $this->attributes['id'])
            ->where(function ($query) use ($now) {
                $query->where('expiracion', '>', $now->toDateString());
                $query->orWhere('expiracion', '=', null);
            })
            ->where('tipo', 'En condominio')
            ->sum('disponibles');
        if ($sum > 0) {
            return $sum;
        } else {
            return 0;
        }
    }

    public function paquetesVencidosCondominio()
    {
        $now = Carbon::now();

        $sum = PaqueteComprado::where('user_id', $this->attributes['id'])
            ->where(function ($query) use ($now) {
                $query->where('expiracion', '<', $now->toDateString());
            })
            ->where('disponibles', '>', '0')
            ->where('tipo', 'En condominio')
            ->sum('disponibles');
        if ($sum > 0) {
            return $sum;
        } else {
            return 0;
        }
    }

    public function condominioAdmin()
    {
        return $this->hasOne('App\Condominio', 'id', 'condominio_id');
    }

    public function clasesInstructor()
    {
        $detalles = Detalle::where('user_id', $this->attributes['id'])
            ->get()
            ->first();
        if ($detalles != null) {
            $clasesIds = explode(",", $detalles->clases);

            return Clase::whereIn('id', $detalles)->get();
        } else {
            return [];
        }

    }

}
