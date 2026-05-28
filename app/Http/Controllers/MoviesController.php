<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest;

class MoviesController extends Controller
{
    // 動画の新規登録画面
    public function create()
    {
        // ログインしているユーザーの情報を取得
        // Facadeを呼び出す時は「\」をつける。
        $user = \Auth::User();

        // 変数moviesに、ユーザーの持つ動画の情報を新しい順に入れる。（表示用）
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];

        return view('movies.create', $data);
    }

    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->save();
        return back(); //直前に表示されていたbladeを再表示する　
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if (\Auth::id() === $movie->user_id) {
            $movie->delete();
        }
        return back();
    }
}
