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
            'name'=>'1hara',
            'email'=>'1hara@test.com',
            'password'=>bcrypt('1hara')
        ]);
        DB::table('users')->insert([
            'name'=>'2hara',
            'email'=>'2hara@test.com',
            'password'=>bcrypt('2hara')
        ]);
        DB::table('users')->insert([
            'name'=>'3hara',
            'email'=>'3hara@test.com',
            'password'=>bcrypt('3hara')
        ]);
        DB::table('users')->insert([
            'name'=>'4hara',
            'email'=>'4hara@test.com',
            'password'=>bcrypt('4hara')
        ]);
    }
}
