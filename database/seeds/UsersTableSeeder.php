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
        $users = [
            ['name' => 'test1', 'email' => 'test1@test.com', 'password' => 'test1'],
            ['name' => 'test2', 'email' => 'test2@test.com', 'password' => 'test2'],
            ['name' => 'test3', 'email' => 'test3@test.com', 'password' => 'test3'],
            ['name' => 'test4', 'email' => 'test4@test.com', 'password' => 'test4'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
            ]);
        }
    }
}
