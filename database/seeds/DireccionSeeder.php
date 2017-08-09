<?php

use Illuminate\Database\Seeder;

class DireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('direcciones')->insert([

        'identificador'=>'Casa',
        'calle'=>'Calle prueba',
        'numero_ext'=>'15',
        'numero_int'=>'1',
        'colonia'=>'Bellavista',
        'municipio_del'=>'Atizaán',
        'cp'=>'52994',
        'estado'=>'CDMX',
        'user_id'=>'2'
      ]);

      DB::table('tarjetas')->insert([

        'identificador'=>'Visa',
        'num'=>'55555555555',
        'nombre'=>'Alexis Morales',
        'mes'=>'02',
        'año'=>'17',
        'user_id'=>'2'
      ]);

    }
}
