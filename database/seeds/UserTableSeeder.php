<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test6',
            'email' => 'test6@test.com',
            'password' => bcrypt('test6')
        ]);
        DB::table('users')->insert([
            'name' => 'test7',
            'email' => 'test7@test.com',
            'password' => bcrypt('test7')
        ]);
        DB::table('users')->insert([
            'name' => 'test8',
            'email' => 'test8@test.com',
            'password' => bcrypt('test8')
        ]);
        DB::table('users')->insert([
            'name' => 'test9',
            'email' => 'test9@test.com',
            'password' =>bcrypt('test9')
        ]);
    }
}
