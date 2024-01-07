<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test11',
            'email' => 'test11@test.com',
            'password' => bcrypt('test11')
        ]);
        DB::table('users')->insert([
            'name' => 'test12',
            'email' => 'test12@test.com',
            'password' => bcrypt('test12')
        ]);
        DB::table('users')->insert([
            'name' => 'test13',
            'email' => 'test13@sample.com',
            'password' => bcrypt('test13')
        ]);
        DB::table('users')->insert([
            'name' => 'test14',
            'email' => 'test14@test.com',
            'password' => bcrypt('test14')
        ]);
    }
}
