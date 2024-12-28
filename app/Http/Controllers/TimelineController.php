<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TimelineController extends Controller
{
    public function index($id)
    {
        // ユーザーの取得
        $user = User::findOrFail($id);

        // 動画とコメントを取得し、コレクション形式でまとめる
        $movies = $user->movies->map(function ($movie) {
            return [
                'type' => 'movie',
                'content' => $movie,
                'created_at' => $movie->created_at,
            ];
        });

        $comments = $user->comments->map(function ($comment) {
            return [
                'type' => 'comment',
                'content' => $comment,
                'created_at' => $comment->created_at,
            ];
        });

        // 動画とコメントを結合し、created_atの降順にソート
        $timeline = $movies->merge($comments)->sortByDesc('created_at');
        $data = $this->userCounts($user);
        // データをビューに渡す
        return view(
            'users.timeline',
            [
                'user' => $user,
                'timeline' => $timeline,
            ],
            $data
        );
    }
}
