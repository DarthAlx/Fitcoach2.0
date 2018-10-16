<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensajes';

	protected $fillable = ['mensaje','user_id','reservacion_id'];

  	public function reservacion(){
       	return $this->belongsTo('App\Reservacion','id','reservacion_id');
    }
}
