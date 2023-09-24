<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //追加　2023.09.23
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'sample1',
            'email' => 'sample1@test.com',
            'password' => bcrypt('sample1')
        ]);
        DB::table('users')->insert([
            'name' => 'sample2',
            'email' => 'sample2@test.com',
            'password' => bcrypt('sample2')
        ]);
        DB::table('users')->insert([
            'name' => 'sample3',
            'email' => 'sample3@test.com',
            'password' => bcrypt('sample3')
        ]);
        DB::table('users')->insert([
            'name' => 'sample4',
            'email' => 'sample4@test.com',
            'password' => bcrypt('sample4')
        ]);
    }
}
