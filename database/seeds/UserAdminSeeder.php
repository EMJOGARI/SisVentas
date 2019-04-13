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
        \DB::table('tb_categoria')->insert([            
            'nombre'    => 'Sin Categoria',
            'condicion' => '1'            
        ]);

    	\DB::table('tb_roles')->insert([            
            'name'        => 'Admin',
            'description' => 'Administrador'            
        ]);

        \DB::table('tb_roles')->insert([            
            'name'        => 'User',
            'description' => 'Usuario'            
        ]);
        
        \DB::table('tb_users')->insert([
            'idrol' => '1',
            'name' => 'Administrador SisVentas',
            'email' => 'admin@sisventas.com',
            'password' => bcrypt('adminsisventas'),
        ]);
        \DB::table('tb_users')->insert([
            'idrol' => '2',
            'name' => 'Usuario SisVentas',
            'email' => 'usuario@sisventas.com',
            'password' => bcrypt('123456'),
        ]);         
    }
}
