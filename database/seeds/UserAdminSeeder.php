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
    	\DB::table('tb_roles')->insert([            
            'name' => 'Administrador'            
        ]);

        \DB::table('tb_roles')->insert([            
            'name' => 'Usuario'            
        ]);
        
        \DB::table('tb_users')->insert([
            'idrol' => '1',
            'name' => 'Administrador SisVentas',
            'email' => 'admin@sisventas.com',
            'password' => bcrypt('123456'),
        ]);          
    }
}
