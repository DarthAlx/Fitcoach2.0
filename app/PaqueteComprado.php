<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteComprado extends Model
{
   	protected $table = 'pagos';

  	protected $fillable = ['user_id', 'clases', 'tipo', 'fecha','expiracion'];

  	public function user(){
       return $this->belongsTo('App\User');
    }
}
