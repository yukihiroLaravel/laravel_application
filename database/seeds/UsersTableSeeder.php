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
        'name' => 'test22',
        'email' => 'test22@test.com',
        'password' => bcrypt('test22')
    ]);

    DB::table('users')->insert([
        'name' => 'test33',
        'email' => 'test33@test.com',
        'password' => bcrypt('test33')
    ]);

    DB::table('users')->insert([
        'name' => 'test44',
        'email' => 'test44@test.com',
        'password' => bcrypt('test44')
    ]);
}
}