<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
  protected $table = 'abonos';
  protected $fillable = ['orden_id', 'user_id','abono'];
  public function user()
     {
       return $this->belongsTo('App\User');
     }
   public function orden()
      {
        return $this->belongsTo('App\Orden');
      }
      public function abonos(){
          return $this->hasOne('App\Abono');
      }
}
