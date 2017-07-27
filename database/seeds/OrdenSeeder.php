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
        'cantidad'=>'500',
        'metadata'=>'particular,08:00 AM',
        'status'=>'terminada'
        ]);
      DB::table('ordenes')->insert([
        'order_id'=>'ordernum258',
        'user_id'=>'2',
        'coach_id'=>'3',
        'nombre'=>'Yoga',
        'fecha'=>'2017-07-30',
        'cantidad'=>'500',
        'metadata'=>'particular,04:00 PM',
        'status'=>'pagada'
        ]);
    }
}
