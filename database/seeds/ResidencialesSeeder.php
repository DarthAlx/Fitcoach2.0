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
        'fecha'=>'2017-08-18',
        'hora'=>'13:00',
        'user_id'=>'3',
        'condominio_id'=>'1',
        'clase_id'=>'1',
        'precio'=>'300',
        'audiencia'=>'Adultos',
        'cupo'=>'50',
        'ocupados'=>'48',
        'tipo'=>'Deportiva',
        'descripcion'=>'Esta es una clase muestra'
      ]);

      DB::table('residenciales')->insert([
        'fecha'=>'2017-08-20',
        'hora'=>'15:00',
        'user_id'=>'3',
        'condominio_id'=>'1',
        'clase_id'=>'1',
        'precio'=>'400',
        'audiencia'=>'Adultos',
        'cupo'=>'50',
        'ocupados'=>'0',
        'tipo'=>'Deportiva',
        'descripcion'=>'Esta es una clase muestra'
      ]);

    }
}
