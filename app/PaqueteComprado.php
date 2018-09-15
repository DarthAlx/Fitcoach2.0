<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteComprado extends Model
{
   	protected $table = 'paquetescomprados';

  	protected $fillable = ['user_id','orden_id', 'clases','disponibles', 'tipo', 'fecha','expiracion'];

  	public function user(){
       return $this->belongsTo('App\User');
    }
    public function orden(){
       return $this->belongsTo('App\Orden');
    }
}
