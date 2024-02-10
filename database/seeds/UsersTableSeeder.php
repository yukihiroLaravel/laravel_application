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
            'name' => 'test10',
            'email' => 'test10@test.com',
            'password' => bcrypt('test10')
        ]);
        DB::table('users')->insert([
            'name' => 'test20',
            'email' => 'test20@test.com',
            'password' => bcrypt('test20')
        ]);
        DB::table('users')->insert([
            'name' => 'test30',
            'email' => 'test30@test.com',
            'password' => bcrypt('test30')
        ]);
        DB::table('users')->insert([
            'name' => 'test40',
            'email' => 'test40@test.com',
            'password' => bcrypt('test40')
        ]);
        DB::table('users')->insert([
            'name' => 'test5',
            'email' => 'test5@test.com',
            'password' => bcrypt('test5')
        ]);
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
    }
}
