<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest; //
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{
    public function create()
    {
        // ユーザがログインしているか確認
        $user = Auth::user();
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
        // favorite_flagは、動画が「お気に入り」かどうかを示すフラグ
        // リクエストからfavorite_flagを取得し、1（true）または0（false）に変換して保存
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
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

    public function edit($id)
    {
        $user = \Auth::user();
        // 動画の詳細情報を取得
        // findOrFail()は、指定したIDのレコードを取得し、存在しない場合は404エラーを返すメソッド
        // 万一IDが存在しないレコードを検索した場合に「見つからない」旨のエラー画面を自動で表示してくれる.
        $movie = Movie::findOrFail($id);
        // 動画の所有者（user_id）が現在ログインしているユーザのIDと一致する場合のみ編集画面を表示
        // 動画一覧を取得し、最新の動画（降順）から9件ずつページ送りする
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data=[
            'user' => $user,
            'movie' => $movie,
            'movies' => $movies,
        ];
        return view('movies.edit', $data);
    }

    public function update(MovieRequest $request, $id)
    {
        // 動画の更新処理
        // findOrFail()は、指定したIDのレコードを取得し、存在しない場合は404エラーを返すメソッド
        $movie = Movie::findOrFail($id);
        // リクエスト（フォームに入力）から取得したYouTubeの動画IDを動画のYouTube IDとして設定
        // ここでは、MovieRequestでバリデーション済みのyoutube_idを使用
        $movie->youtube_id = $request->youtube_id;
        // リクエストから取得したタイトルを動画のタイトルとして設定
        $movie->title = $request->title;
        // リクエストから取得したユーザIDを動画のユーザIDとして設定
        $movie->user_id = $request->user()->id;
        // リクエストから取得したfavorite_flagを動画のfavorite_flagとして設定
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->save();
        return back();
    }

    public function search(Request $request)
    {
        $query = Movie::query();
        // 検索キーワードを取得
        $keyword = $request->input('keyword');
        // キーワードが空でない場合、動画を検索
        if (isset($keyword) != '') {
            // Movieモデルのwhereメソッドを使用して、タイトルにキーワードが含まれる動画を取得
            $query->where('title', 'like', "%{$keyword}%")->orderBy('id', 'desc');
        } else {
            // キーワードが空の場合は、全ての動画を取得
            $query->orderBy('id', 'desc');
        }
        $searchmovies = $query->paginate(9);
        $data = [
            'searchmovies' => $searchmovies,
            'keyword' => $keyword,
        ];

        // ビューに渡すデータを配列で定義
        return view('movies.search', $data);
    }

    public function show($id)
    {
        // ユーザの詳細情報を取得
        // findOrFail()は、指定したIDのレコードを取得し、存在しない場合は404エラーを返すメソッド
        $movie = Movie::findOrFail($id);
        // 動画の所有者（user_id）が現在ログインしているユーザのIDと一致する場合のみ動画の詳細を表示
        
        // 動画の詳細情報をビューに渡す
        // 'movies.show'は、resources/views/movies/show.blade.phpを指す
        return view('movies.show')->with('movie',$movie);
        // with()メソッドは、ビューにデータを渡すためのメソッドで、第一引数に変数名、第二引数に値を指定する
        // ここでは、'movie'という変数名で動画の詳細情報をビューに渡す
    }
}   