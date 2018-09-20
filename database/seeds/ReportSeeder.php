<?php

use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = new \App\Modulo();
        $modules->nombre = 'reportes';
        $modules->save();
    }
}
