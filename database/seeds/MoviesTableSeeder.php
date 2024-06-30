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
        // tinkerの内容より、とりあえず、user_id=2に紐づけ
        // paginateの確認をしたいからある程度の件数で登録しておく
        $insertCount = 11;
        for($index = 0 ; $index < $insertCount ; ++$index) {
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
            $movie->user_id = 2; // $user->id;
            $movie->save();    
        }
    }
}
