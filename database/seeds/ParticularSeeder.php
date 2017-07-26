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
        'hora'=>'7:00 PM',
        'user_id'=>'2',
        'clase_id'=>'1',
        'zonas'=>'1,2',
        'recurrencia'=>'1,2'
      ]);
      DB::table('particulares')->insert([
        'fecha'=>'30-07-2017',
        'hora'=>'8:00 PM',
        'user_id'=>'2',
        'clase_id'=>'1',
        'zonas'=>'1,2',
        'recurrencia'=>''
      ]);
    }
}
