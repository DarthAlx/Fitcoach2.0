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
            'name'=>'Alexis Morales',
            'email'=>'user@outlook.com',
            'password'=>bcrypt('admin123'),
            'tel'=>'5555555555',
            'role' =>'usuario'
        ]);
      DB::table('users')->insert([
            'name'=>'Herman Müller',
            'email'=>'coach@outlook.com',
            'password'=>bcrypt('admin123'),
            'role' =>'instructor'
        ]);
        DB::table('users')->insert([
              'name'=>'Herman Müller2',
              'email'=>'coach2@outlook.com',
              'password'=>bcrypt('admin123'),
              'role' =>'instructor'
          ]);
        DB::table('users')->insert([
              'name'=>'Herman Müller',
              'email'=>'admin2@outlook.com',
              'password'=>bcrypt('admin123'),
              'role' =>'admin'
          ]);
    }
}
