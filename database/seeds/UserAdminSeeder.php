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
        \DB::table('users')->insert([
            'name' => 'Admin SisVentas',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}