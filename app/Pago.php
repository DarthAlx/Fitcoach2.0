<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
  protected $table = 'pagos';

  protected $fillable = ['user_id', 'fecha', 'metodo', 'referencia','monto', 'deducciones', 'ordenes'];

  public function user(){
       return $this->belongsTo('App\User');
     }
}
