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
            $name = 'test' . $i;
            $email = "test{$i}@test.com";
            $password = bcrypt($name);
        
            // 既に同じメールアドレスが存在しないか確認
            if (!DB::table('users')->where('email', $email)->exists()) {
                DB::table('users')->insert([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ]);
            }
        }
        
        //➁'test1@test.com' というメールアドレスが既に存在しており、一意性が保たれていないため、新しいデータを挿入できないというものです。
        // for ($i = 1; $i <= 4; $i++) {
        //     $name = 'test' . $i;
        //     $email = "test{$i}@test.com";
        //     $password = bcrypt($name);
        // 
        //     DB::table('users')->insert([
        //         'name' => $name,
        //         'email' => $email,
        //         'password' => $password,
        //     ]);
        // }
        
        // ➀回答
        // DB::table('users')->insert([
        //     'name' => 'test1',
        //     'email' => 'test1@test.com',
        //     'password' => bcrypt('test1')
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'test2',
        //     'email' => 'test2@test.com',
        //     'password' => bcrypt('test2')
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'test3',
        //     'email' => 'test3@sample.com',
        //     'password' => bcrypt('test3')
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'test4',
        //     'email' => 'test4@test.com',
        //     'password' => bcrypt('test4')
        // ]);
    }
}
