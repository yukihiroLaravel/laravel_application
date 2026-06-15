<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest;

class MoviesController extends Controller
{
    public function create()
    {
        // Facadeを宣言 ログインしているユーザを取得
        $user = \Auth::user();
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        return view('movies.create', $data);
    }

    // 動画を保存するアクション
    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0; // いいね！許可フラグ
        $movie->save();
        return back();
    }

    // 動画を削除するアクション
    public function destroy($id)
    {
        // 存在しないIDが指定された場合は、エラーを表示させるメソッド
        $movie = Movie::findOrFail($id);
        // ログインしているユーザIDと、動画のユーザIDが同じ場合のみ、動画を削除する
        if (\Auth::id() === $movie->user_id) {
            $movie->delete();
        }
        return back();
    }

    // 動画編集画面を表示するためのアクション
    public function edit($id)
    {
        $user = \Auth::user();
        $movie = Movie::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movie' => $movie,
            'movies' => $movies,
        ];
        return view('movies.edit', $data);
    }

    // 編集された動画を更新するアクション
    public function update(MovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->save();
        return back();
    }
}
