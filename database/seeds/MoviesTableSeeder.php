<?php

use App\Movie;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ************************************************************
        // tinkerの内容を参考にして、user_idに、$paramMapの各、$userId
        // を指定する形で登録する。
        // 各ユーザについて、movies.blade.phpでのページャー、
        // paginateの確認できるレベルの件数を追加したいが
        // ユーザーごとに、件数は変更したい。
        // ************************************************************

        // keyがuserId, valueが件数
        $paramMap = [ 
            13 => 21,
            12 => 15,
            7 => 10,
            5 => 31,
            3 => 9,
            2 => 12,
        ];
        foreach ($paramMap as $userId => $itemCount) {
            for($index = 0 ; $index < $itemCount ; ++$index) {
                $movie = new Movie();
    
                $youtube_id = "";
                $title = "";
                if( ($index % 2) === 0 ) {
                    $youtube_id = 'I9xgwLfNnD4';
                    $title = 'Lessons Of PHP 1';
                } else {
                    $youtube_id = 'GJn1d9HPQtU';
                    $title = '三国志　Three Kingdoms 1〜2話【日本語吹替】';
                }
                $movie->youtube_id = $youtube_id;
                $movie->title = $title;
                $movie->user_id = $userId; //2; // $user->id;
                $movie->save();
            }
        }
    }
}
