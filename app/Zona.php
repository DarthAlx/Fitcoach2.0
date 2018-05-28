<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Zona extends Model
{
  protected $table = 'zonas';
  protected $fillable = ['identificador', 'descripcion'];
  public function horarios()
     {
       return $this->hasMany('App\Horario');
     }

}