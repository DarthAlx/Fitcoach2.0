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
	        'paquete'=>'Primer clase',
	        'precio'=>'399',
	        'num_clases'=>'1',
	        'dias'=>'15',
	        'tipo'=>'Particulares'
	    ]);
        DB::table('paquetes')->insert([
	        'paquete'=>'1',
	        'precio'=>'599',
	        'num_clases'=>'1',
	        'dias'=>'15',
	        'tipo'=>'Particulares'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'2',
	        'precio'=>'2320',
	        'num_clases'=>'4',
	        'dias'=>'30',
	        'tipo'=>'Particulares'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'3',
	        'precio'=>'4500',
	        'num_clases'=>'8',
	        'dias'=>'60',
	        'tipo'=>'Particulares'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'4',
	        'precio'=>'8800',
	        'num_clases'=>'16',
	        'dias'=>'120',
	        'tipo'=>'Particulares'
	    ]);



	    DB::table('paquetes')->insert([
	        'paquete'=>'Primer clase',
	        'precio'=>'150',
	        'num_clases'=>'1',
	        'dias'=>'15',
	        'tipo'=>'Residenciales'
	    ]);
        DB::table('paquetes')->insert([
	        'paquete'=>'1',
	        'precio'=>'200',
	        'num_clases'=>'1',
	        'dias'=>'15',
	        'tipo'=>'Residenciales'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'2',
	        'precio'=>'1200',
	        'num_clases'=>'8',
	        'dias'=>'45',
	        'tipo'=>'Residenciales'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'3',
	        'precio'=>'2080',
	        'num_clases'=>'16',
	        'dias'=>'75',
	        'tipo'=>'Residenciales'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'4',
	        'precio'=>'2640',
	        'num_clases'=>'24',
	        'dias'=>'100',
	        'tipo'=>'Residenciales'
	    ]);
        

    }
}
