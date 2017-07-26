<?php

use Illuminate\Database\Seeder;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clases')->insert([
          'nombre'=>'Yoga',
          'tipo'=>'Deportiva',
          'descripcion'=>'Clases de yoga y relajación',
          'imagen' =>'Yoga-1499123339.jpg',
          'precio' =>'500'
        ]);
    }
}
