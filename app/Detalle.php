<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = 'detalles';
    protected $fillable = ['photo', 'tel', 'intereses', 'permisos', 'rfc', 'clases', 'user_id'];
    public function user(){
     return $this->belongsTo('App\User');
    }
}
