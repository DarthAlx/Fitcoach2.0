<?php

use Illuminate\Database\Seeder;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('zonas')->insert([
            'identificador'=>'Polanco',
            'descripcion'=>'Abarca todas las secciones.'
        ]);


        DB::table('zonas')->insert([
              'identificador'=>'Condesa',
              'descripcion'=>'Abarca todas las secciones.'
          ]);
    }
}
