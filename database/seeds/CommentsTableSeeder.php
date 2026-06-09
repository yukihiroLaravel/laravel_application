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
            $parentComment = Comment::create([
                'content' => 'これは親コメントです。',
                'movie_id' => $movie->id,
                'user_id' => $user->id,
                'parent_id' => null,
            ]);

            $reply = Comment::create([
                'content' => 'これは親コメントへの返信です。',
                'movie_id' => $movie->id,
                'user_id' => $user->id,
                'parent_id' => $parentComment->id,
            ]);

            Comment::create([
                'content' => 'これは返信への返信です。',
                'movie_id' => $movie->id,
                'user_id' => $user->id,
                'parent_id' => $reply->id,
            ]);
        }
    }
}