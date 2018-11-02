<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = ['user_id', 'fecha', 'metodo', 'referencia', 'monto', 'deducciones', 'ordenes', 'iva', 'factura'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getDeduccionesAttribute()
    {
        if (count($this->attributes['deducciones']) > 0) {
            return intval($this->attributes['deducciones']);
        } else {
            return 0;
        }
    }

    public function getMontoAttribute()
    {
        if (count($this->attributes['monto']) > 0) {
            return intval($this->attributes['monto']);
        } else {
            return 0;
        }
    }

    public function getIvaAttribute()
    {
        if (count($this->attributes['iva']) > 0) {
            return intval($this->attributes['iva']);
        } else {
            return 0;
        }
    }
}
