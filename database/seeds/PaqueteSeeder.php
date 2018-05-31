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
            'precio_clase'=>'399',
	        'num_clases'=>'1',
	        'dias'=>'15',
	        'tipo'=>'A domicilio'
	    ]);
        DB::table('paquetes')->insert([
	        'paquete'=>'1',
	        'precio'=>'599',
            'precio_clase'=>'599',
	        'num_clases'=>'1',
	        'dias'=>'15',
	        'tipo'=>'A domicilio'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'2',
	        'precio'=>'2320',
            'precio_clase'=>'580',
	        'num_clases'=>'4',
	        'dias'=>'30',
	        'tipo'=>'A domicilio'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'3',
	        'precio'=>'4500',
            'precio_clase'=>'562',
	        'num_clases'=>'8',
	        'dias'=>'60',
	        'tipo'=>'A domicilio'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'4',
	        'precio'=>'8800',
            'precio_clase'=>'550',
	        'num_clases'=>'16',
	        'dias'=>'120',
	        'tipo'=>'A domicilio'
	    ]);



	    DB::table('paquetes')->insert([
	        'paquete'=>'Primer clase',
	        'precio'=>'150',
            'precio_clase'=>'150',
	        'num_clases'=>'1',
	        'dias'=>'15',
	        'tipo'=>'En condominio'
	    ]);
        DB::table('paquetes')->insert([
	        'paquete'=>'1',
	        'precio'=>'200',
            'precio_clase'=>'200',
	        'num_clases'=>'1',
	        'dias'=>'15',
	        'tipo'=>'En condominio'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'2',
	        'precio'=>'1200',
            'precio_clase'=>'150',
	        'num_clases'=>'8',
	        'dias'=>'45',
	        'tipo'=>'En condominio'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'3',
	        'precio'=>'2080',
            'precio_clase'=>'130',
	        'num_clases'=>'16',
	        'dias'=>'75',
	        'tipo'=>'En condominio'
	    ]);
	    DB::table('paquetes')->insert([
	        'paquete'=>'4',
	        'precio'=>'2640',
            'precio_clase'=>'110',
	        'num_clases'=>'24',
	        'dias'=>'100',
	        'tipo'=>'En condominio'
	    ]);
        

    }
}
