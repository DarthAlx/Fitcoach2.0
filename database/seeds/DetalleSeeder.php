<?php

use Illuminate\Database\Seeder;

class DetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('detalles')->insert([
        'permisos'=>'',
        'user_id'=>'1'
      ]);
      DB::table('detalles')->insert([
        'permisos'=>'',
        'user_id'=>'2'
      ]);

    }
}
