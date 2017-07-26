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
        'fecha'=>'30-07-2017',
        'cantidad'=>'500',
        'metadata'=>'metadata',
        'status'=>'pagada'
        ]);
    }
}
