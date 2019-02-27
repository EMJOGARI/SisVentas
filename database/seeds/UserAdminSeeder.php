<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert([            
            'name' => 'Administrador'            
        ]);

        \DB::table('users')->insert([
            'idrol' => '1',
            'name' => 'Administrador SisVentas',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);        
    }
}
