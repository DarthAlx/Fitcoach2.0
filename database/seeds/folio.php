<?php

use Illuminate\Database\Seeder;

class folio extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('folio')->insert([
        'folio'=>'10000'
      ]);
    }
}
