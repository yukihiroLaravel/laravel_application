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
        for ($i = 1; $i <= 4; $i++) {
            DB::table('users')->insert([
                'name' => 'test2-' . $i,
                'email' => 'test' . $i . '@test2.com',
                'password' => bcrypt('test2-' . $i)
            ]);
        }
    }
}
