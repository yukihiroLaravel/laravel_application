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
}
