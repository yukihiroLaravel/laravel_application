<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest;
// MovieRequestを使うために追記
// MovieRequestは、動画の新規登録や更新時に必要なバリデーションを定義したクラス

class MoviesController extends Controller
{
    // 動画の新規登録画面を表示する
    public function create()
    {
        // ユーザがログインしているか確認
        $user = \Auth::user();

        // 動画情報を取得　（ログインしている）ユーザーが持っている動画を新しい順（降順）に並べ、１ページに9件ずつ表示
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);

        // ユーザ情報と動画情報を配列に格納（viewに渡すため）
        // $userはログインしているユーザの情報、$moviesはそのユーザが持っている動画の情報
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];

        // 動画の新規登録画面を表示する（viewに渡す）
        return view('movies.create', $data);
    }

    // 動画の新規登録処理
    // MovieRequestを使って、リクエストのバリデーションを行う
    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        // リクエストから取得したyoutube_idとtitleをMovieモデルにセット
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        // user_idは、現在ログインしているユーザのIDをセット
        $movie->user_id = $request->user()->id;
        // favorite_flagは、リクエストから取得した値を元に、1（true）または0（false）に変換してセット
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        // 動画の新規登録を行う
        $movie->save();
        // 動画の新規登録が成功したら、create.blade.phpにリダイレクト
        // リダイレクト先は、動画の一覧ページ（create.blade.php）にする
        return back();
    }
    // 動画の削除処理
    public function destroy($id)
    {
        // 動画を削除する
        // findOrFailメソッドは、指定したIDの動画が存在しない場合に404エラーを返す
        // 404エラーが発生した場合、Laravelは自動的にエラーページを表示する
        // ここで、動画のIDを引数として受け取り、そのIDに対応する動画をデータベースから取得
        // もし動画が存在し、かつその動画の所有者が現在ログインしているユーザと一致する場合のみ削除を実行
        // \Auth::id()は、現在ログインしているユーザのIDを取得する
        $movie = Movie::findOrFail($id);
        if (\Auth::id() === $movie->user_id) {
            $movie->delete();
        }
        return back();
    }
    // 動画の編集画面を表示する
    public function edit($id)
    {
        // 動画のIDを引数として受け取り、そのIDに対応する動画をデータベースから取得
        // もし動画が存在し、かつその動画の所有者が現在ログインしているユーザと一致する場合のみ編集画面を表示
        $user = \Auth::user();
        $movie = Movie::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data=[
            'user' => $user,
            'movie' => $movie,
            'movies' => $movies,
        ];
        return view('movies.edit', $data);
    }
    // 動画の更新処理
    public function update(MovieRequest $request, $id)
    {
        // リクエストから取得したIDに対応する動画をデータベースから取得
        // findOrFailメソッドは、指定したIDの動画が存在しない場合に404エラーを返す
        $movie = Movie::findOrFail($id);
        // 現在ログインしているユーザのIDと、動画の所有者のIDが一致する場合のみ更新を実行
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        // リクエストから取得したfavorite_flagを元に、1（true）または0（false）に変換してセット
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->save();
        return back();
    }
}
