<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'confirmed' => 1,
            'first_name' => 'Angel',
            'last_name' => 'Hernandez',
            'email' => 'anruhe.q@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'regular'
        ]);

        DB::table('users')->insert([
            'confirmed' => 1,
            'first_name' => 'Admin',
            'email' => 'admin@mydomain.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
    }
}
