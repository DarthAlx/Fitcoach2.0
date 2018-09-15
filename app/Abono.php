<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
  protected $table = 'abonos';
  protected $fillable = ['reservacion_id', 'user_id','abono'];
  public function user()
     {
       return $this->belongsTo('App\User');
     }
   public function reservacion()
      {
        return $this->belongsTo('App\Reservacion');
      }

}
