<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 2024/06/29
        // paginateの確認をしたいから件数を増やす
        $insertCount = 14;
        for($index = 0 ; $index < $insertCount ; ++$index) {

            // 1はじまりindex の文字列
            $strIndexOneBase = strval($index + 1);

            $strCurrentId = 'test' . $strIndexOneBase;
            
            // DB::table('users')->insert([
            //     'name' => 'test1',
            //     'email' => 'test1@test.com',
            //     'password' => bcrypt('test1'),
            // ]);
            // 上記の、
            // test1　を、test1～testNまで( $insertCountの分だけ、)
            // 文字列をあてはめてinsertする。
    
            DB::table('users')->insert([
                'name' => $strCurrentId,
                'email' => $strCurrentId .'@test.com',
                'password' => bcrypt($strCurrentId),
            ]);
        }
    }
}
