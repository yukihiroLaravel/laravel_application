<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Request\MovieRequest;

class MoviesController extends Controller
{
    public function create()
    {
        $user = \Auth::user();//ログイン認証
        $movies = $user->movies()->orderBy('id','desc')->paginate(9);//動画をIDの降順で９つまで１ページに収める。
        $data = [
                'user' => $user,//ビューに渡す準備。ユーザー情報
                'movies' => $movies,//ビューに渡す準備。動画情報
        ];

        return view('movies.create',$data);//ユーザー、動画情報をmovies.createに渡しビューで表示。
    }

    public function store(MovieRequest $request) //MovieRequestクラスでバリデーションが実行され、バリデーション後のデータが$requestに格納されstoreに渡される。※自動的にクラスのインスタンスが生成される。
    {
        $movie = new Movie; //Movieクラスをインスタンス化。下記の$request->はバリデーション後のデータという意味。
        $movie->youtube_id = $request->youtube_id; //バリデーション後のyoutube_idのをmovieクラスのyoutube_idの変数に渡している。
        $movie->title = $request->title; //バリデーション後のtitleをmovieクラスのtitleに渡している。
        $movie->user_id = $request->user()->id;
        $movie->save();
        return back();
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if(\Auth::id() === $movie->user_id){
            $movie->delete();
        }
        return back();
    }

}
