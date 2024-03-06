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
            'name' => 'demo1',
            'email' => 'demo1@demo.com',
            'password' => bcrypt('demo1')
        ]);
        DB::table('users')->insert([
            'name' => 'demo2',
            'email' => 'demo2@demo.com',
            'password' => bcrypt('demo2')
        ]);
        DB::table('users')->insert([
            'name' => 'demo3',
            'email' => 'demo3@demo.com',
            'password' => bcrypt('demo3')
        ]);
        DB::table('users')->insert([
            'name' => 'demo4',
            'email' => 'demo4@demo.com',
            'password' => bcrypt('demo4')
        ]);
        DB::table('users')->insert([
            'name' => 'demo5',
            'email' => 'demo5@demo.com',
            'password' => bcrypt('demo5')
        ]);
        DB::table('users')->insert([
            'name' => 'demo6',
            'email' => 'demo6@demo.com',
            'password' => bcrypt('demo6')
        ]);
        DB::table('users')->insert([
            'name' => 'demo7',
            'email' => 'demo7@demo.com',
            'password' => bcrypt('demo7')
        ]);
    }
}
