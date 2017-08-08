<?php

use Illuminate\Database\Seeder;

class OrdenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('ordenes')->insert([
        'order_id'=>'ordernum258',
        'user_id'=>'2',
        'coach_id'=>'3',
        'nombre'=>'Yoga',
        'fecha'=>'2017-07-27',
        'hora'=>'13:00',
        'cantidad'=>'500',
        'metadata'=>'particular,1',
        'status'=>'terminada'
        ]);

        DB::table('ordenes')->insert([
          'order_id'=>'ordernum258',
          'user_id'=>'2',
          'coach_id'=>'3',
          'nombre'=>'Yoga',
          'fecha'=>'2017-07-27',
          'hora'=>'08:00',
          'cantidad'=>'500',
          'metadata'=>'residencial,1',
          'status'=>'pagada'
          ]);

      DB::table('ordenes')->insert([
        'order_id'=>'ordernum258',
        'user_id'=>'2',
        'coach_id'=>'3',
        'nombre'=>'Yoga',
        'fecha'=>'2017-07-30',
        'hora'=>'16:00',
        'cantidad'=>'500',
        'metadata'=>'particular,1',
        'status'=>'pagada'
        ]);

        DB::table('ordenes')->insert([
          'order_id'=>'ordernum258',
          'user_id'=>'2',
          'coach_id'=>'3',
          'nombre'=>'Yoga',
          'fecha'=>'2017-08-05',
          'hora'=>'7:00',
          'cantidad'=>'500',
          'metadata'=>'particular,1',
          'status'=>'pagada'
          ]);
    }
}
