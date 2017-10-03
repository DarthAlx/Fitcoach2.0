<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
            'name'=>'Alexis',
            'email'=>'alx.morales@outlook.com',
            'password'=>bcrypt('admin123'),
            'role' =>'superadmin'
        ]);

      DB::table('users')->insert([
            'name'=>'Herman Müller',
            'email'=>'hmuller@fitcoach.mx',
            'password'=>bcrypt('admin123'),
            'role' =>'superadmin'
        ]);

      
    }
}
