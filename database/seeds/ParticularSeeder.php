<?php

use Illuminate\Database\Seeder;

class ParticularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('particulares')->insert([
        'fecha'=>'',
        'hora'=>'7:00',
        'user_id'=>'3',
        'clase_id'=>'1',
        'recurrencia'=>'1,2'
      ]);
      DB::table('particulares')->insert([
        'fecha'=>'2017-08-05',
        'hora'=>'8:00',
        'user_id'=>'3',
        'clase_id'=>'1',
        'recurrencia'=>''
      ]);
    }
}
