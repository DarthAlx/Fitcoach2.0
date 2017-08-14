<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
  protected $table = 'ordenes';
  protected $fillable = ['order_id', 'user_id','coach_id','folio', 'nombre','fecha','hora', 'cantidad', 'metadata', 'status'];
  public function user()
     {
       return $this->belongsTo('App\User');
     }
}
