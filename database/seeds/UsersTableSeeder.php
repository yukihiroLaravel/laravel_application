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
            'name' => 'test1',
            'email' => 'test17@test.com',
            'password' => bcrypt('test1')
        ]);
        DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'test27@test.com',
            'password' => bcrypt('test2')
        ]);
        DB::table('users')->insert([
            'name' => 'test3',
            'email' => 'test37@sample.com',
            'password' => bcrypt('test3')
        ]);
        DB::table('users')->insert([
            'name' => 'test4',
            'email' => 'test47@test.com',
            'password' => bcrypt('test4')
        ]);
    
    
    
    
    }
}
