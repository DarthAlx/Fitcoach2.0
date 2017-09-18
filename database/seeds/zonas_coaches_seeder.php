<?php

use Illuminate\Database\Seeder;

class zonas_coaches_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('zonas_coaches')->insert([
            'user_id'=>3,
            'zona_id'=>1
        ]);
      DB::table('zonas_coaches')->insert([
            'user_id'=>4,
            'zona_id'=>1
        ]);
    }
}
