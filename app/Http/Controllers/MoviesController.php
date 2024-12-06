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
        $user = \Auth::user();
        // Authはファサード
        //コントローラーでAuthファサードを呼び出す時は、「\」をつける決まりがある
        // 「$user = \Auth::user();」でログインしているユーザー情報を取得する
        //Movieモデルのuser()から来ている なぜここでuser()を使用してユーザー情報を呼び出しているかというと、Userモデルから呼び出すと$user = \Auth::user();に比べてコードが少し複雑になるから。
        //もしUserモデルから呼び出すとすると、$user = User::find(Auth::id());になる

        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        //$user->movies()はuser.phpのモデルからきている
        //ユーザーの持つ動画を、idの新しい順に並び替えて、さらに、1ページ9個の動画まで表示できる、というものを$moviesに代入する
        //動画登録画面に、今までの動画一覧を見れるようにするため

        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        return view('movies.create', $data);
    }

    public function store(MovieRequest $request)
    //MovieRequestはバリデーションを表す 別ファイルにバリデーションを書く
    //バリデーションを切り分けるの仕組み自体をフォームリクエストという
    //$requestの中に、ポストで送られた値が入ってくる。つまり動画登録のポストリクエストの値が入ってくる
    {
        $movie = new Movie;
        //Movie.phpから来ているから、Movieモデルのカラムが使える

        $movie->youtube_id = $request->youtube_id;
        //カラム         　　//create.blade.phpからのname属性

        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        //ログインしている情報が$request->user()で取ってこれる
        //laravelの備え付け
        $movie->save();
        return back();
        //ここの「youtube_id」「title」は、create.blade.phpで書いたname属性
        //「back()」直前に表示されていたviewを表示させる
        //動画作成した後に、もう一度同じ動画作成画面に戻れる。なのでここで連続して動画が投稿できるということ
    }


    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        // findOrFailは、idで動画を探してくれるプラス、もしidが存在しないレコードだったら、見つからないということを自動で表示してくれる関数

        if (\Auth::id() === $movie->user_id) {
            $movie->delete();
            //ログインしているユーザー本人しか、動画を消せないようにしている
        }
        return back();
    }
}
