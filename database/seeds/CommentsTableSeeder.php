<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\Movie;
use App\User;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        $movie = Movie::first();
        $user = User::first();

        if ($movie && $user) {
            Comment::create([
                'content' => 'これはテストコメントです。',
                'movie_id' => $movie->id,
                'user_id' => $user->id,
            ]);

            Comment::create([
                'content' => '動画詳細ページのコメント表示確認用です。',
                'movie_id' => $movie->id,
                'user_id' => $user->id,
            ]);
        }
    }
}