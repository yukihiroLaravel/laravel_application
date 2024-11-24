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

        $nos = array(9, 10, 11, 12);

        foreach ($nos as $no){

            DB::table('users')->insert([
                'name' => "test{$no}",
                'email' => "test{$no}@test.com",
                'password' => bcrypt("test{$no}")
            ]);

        }
    }
}
