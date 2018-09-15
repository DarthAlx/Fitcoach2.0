<?php

use Illuminate\Database\Seeder;

class CondominioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('condominios')->insert([
            'identificador'=>'Condominio X',
            'direccion'=>'Aquí va la dirección.',
            'imagen'=>'condominio.png'
        ]);
    }
}
