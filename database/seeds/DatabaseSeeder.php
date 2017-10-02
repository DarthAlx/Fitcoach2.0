<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UserSeeder::class);
        $this->call(DetalleSeeder::class);
        $this->call(DireccionSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(ClaseSeeder::class);
        $this->call(ZonaSeeder::class);
        $this->call(CondominioSeeder::class);
        $this->call(OrdenSeeder::class);
        $this->call(ParticularSeeder::class);
        $this->call(ResidencialesSeeder::class);
        $this->call(folio::class);
        $this->call(ModuloSeeder::class);

        Model::reguard();
    }
}
