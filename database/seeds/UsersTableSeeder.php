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
            'name' => 'one',
            'email' => 'one@one.com',
            'password' => bcrypt('one')
        ]);
        DB::table('users')->insert([
            'name' => 'two',
            'email' => 'two@two.com',
            'password' => bcrypt('two')
        ]);
        DB::table('users')->insert([
            'name' => 'three',
            'email' => 'three3@three.com',
            'password' => bcrypt('three')
        ]);
        DB::table('users')->insert([
            'name' => 'four',
            'email' => 'four@four.com',
            'password' => bcrypt('four')
        ]);
    }
}