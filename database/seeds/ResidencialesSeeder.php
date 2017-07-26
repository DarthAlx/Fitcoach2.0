<?php

use Illuminate\Database\Seeder;

class ResidencialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('residenciales')->insert([
        'fecha'=>'01/08/2017',
        'hora'=>'3:00 PM',
        'user_id'=>'2',
        'condominio_id'=>'1',
        'clase_id'=>'1',
        'precio'=>'300',
        'audiencia'=>'Adultos',
        'cupo'=>'50',
        'tipo'=>'Deportiva',
        'descripcion'=>'Esta es una clase muestra'
      ]);

    }
}
