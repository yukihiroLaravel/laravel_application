<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest; //

class MoviesController extends Controller
{
    public function create()
    {
        // ユーザがログインしているか確認
        $user = \Auth::user();
        // ユーザーが持っている動画情報を取得し、最新の動画（降順）から9件ずつページ送りする
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        // ビューに渡すデータを配列で定義　ビューに渡すデータが多い場合は、配列でまとめて渡す方が可読性が高くなる
        // 'user'はログインしているユーザ情報、'movies'はユーザが持っている動画一覧情報
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        return view('movies.create', $data);
    }

    // MovieRequest ー 今までコントローラに直接書いていたバリデーションを、別ファイルに切り分ける役割を担っています（変更に強くするため）。
    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->save();
        // 動画登録後、動画一覧ページにリダイレクト
        // return back(); ー view() でviewを表示させる代わりに、
        // メソッドの終わりに、直前に表示されていたviewを表示させる役割があります。
        return back();
    }

    public function destroy($id)
    {
        // 動画の削除
        // findOrFail()は、指定したIDのレコードを取得し、存在しない場合は404エラーを返すメソッド
        // 万一IDが存在しないレコードを検索した場合に「見つからない」旨のエラー画面を自動で表示してくれる.
        // $idは、ルーティングで指定された動画のID

        // \Auth::id()は、現在ログインしているユーザのIDを取得するメソッド
        // 動画の所有者（user_id）が現在ログインしているユーザのIDと一致する場合のみ削除を実行
        $movie = Movie::findOrFail($id);
        if (\Auth::id() === $movie->user_id) {
            $movie->delete();
        }
        
        // 動画削除後、動画一覧ページにリダイレクト
        // back()は、直前のリクエストのURLにリダイレクトするメソッド
        return back();
    }
}