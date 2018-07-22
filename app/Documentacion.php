<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    protected $table = 'documentacion';
    protected $fillable = ['rfc','ine','curp','acta','domicilio','certificaciones','recomendacion1','recomendacion2','user_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
