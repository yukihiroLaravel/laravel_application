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
        for ($i=0;$i<=10;$i++){
            DB::table('users')->insert([
                'name' => 'testtest'.$i,
                'email' => 'testest'.$i.'@test.com',
                'password' => bcrypt('testtest'.$i)
            ]);
        }

        // DB::table('users')->insert([
        //     'name' => 'test2',
        //     'email' => 'test2@test.com',
        //     'password' => bcrypt('test2')
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'test3',
        //     'email' => 'test3@test.com',
        //     'password' => bcrypt('test3')
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'test4',
        //     'email' => 'test4@test.com',
        //     'password' => bcrypt('test4')
        // ]);
    }
}
