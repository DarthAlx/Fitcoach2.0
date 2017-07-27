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
        'tel'=>'5555555',
        'intereses'=>'Yoga',
        'user_id'=>'2'
      ]);

      DB::table('detalles')->insert([
        'photo'=>'dummy.png',
        'tel'=>'5555555',
        'rfc'=>'MOAJ920930LK0',
        'clases'=>'1',
        'user_id'=>'3'
      ]);
    }
}
