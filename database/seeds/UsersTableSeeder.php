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
        $usersData = [];

        for ($i = 1; $i <= 4; $i++) {
            $userData = [
                'name' => 'test' . $i,
                'email' => 'test' . $i . '@test.com',
                'password' => bcrypt('test' . $i)
            ];
            $usersData[] = $userData;
        }
        
        foreach ($usersData as $userData) {
            DB::table('users')->insert($userData);
        }        
    }
}
