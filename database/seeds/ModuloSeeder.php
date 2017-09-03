<?php

use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('modulos')->insert([
        'nombre'=>'usuarios'
      ]);
      DB::table('modulos')->insert([
        'nombre'=>'condominios'
      ]);
      DB::table('modulos')->insert([
        'nombre'=>'grupos'
      ]);
      DB::table('modulos')->insert([
        'nombre'=>'ventas'
      ]);
      DB::table('modulos')->insert([
        'nombre'=>'clases'
      ]);
      DB::table('modulos')->insert([
        'nombre'=>'clientes'
      ]);
      DB::table('modulos')->insert([
        'nombre'=>'nomina'
      ]);
      DB::table('modulos')->insert([
        'nombre'=>'listas'
      ]);

    }
}
