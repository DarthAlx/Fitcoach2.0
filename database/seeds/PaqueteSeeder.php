<?php

use Illuminate\Database\Seeder;

class PaqueteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paquetes')->insert([
	        'paquete'=>'1',
	        'precio'=>'200',
	        'num_clases'=>'1',
	        'dias'=>'15',
	        'tipo'=>'Particular'
	    ]);
        

    }
}
