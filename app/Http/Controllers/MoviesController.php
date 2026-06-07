<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest; 

class MoviesController extends Controller
{
    // 動画の登録画面の表示アクション
    public function create()
    {
        $user = \Auth::user();
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];

        return view('movies.create', $data);
    }

    // 動画登録のアクション
    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->save();
        return back();
    }

    // 動画削除アクション
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if (\Auth::id() === $movie->user_id) {
            $movie->delete();
        }
        return back();
    }
}
