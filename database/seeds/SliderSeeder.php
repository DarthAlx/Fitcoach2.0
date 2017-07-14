<?php

use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('slider')->insert([
        'description'=>'<h3 style="color: #">clases a domicilio <br><a class="learnMore" href="#D58628">PROXIMAMENTE</a></h3>',
        'image'=>'bg-clases.jpg',
        'order'=>'1'
        ]);
    }
}
