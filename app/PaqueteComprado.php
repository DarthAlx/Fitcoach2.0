<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteComprado extends Model
{
   	protected $table = 'paquetescomprados';

  	protected $fillable = ['user_id', 'clases', 'tipo', 'fecha','expiracion'];

  	public function user(){
       return $this->belongsTo('App\User');
    }
    public function paquete(){
       return $this->hasOne('App\PaqueteComprado');
    }
}
