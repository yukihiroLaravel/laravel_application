<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 追記
use App\Movie; // 追記
use App\Http\Requests\MovieRequest; // 追記(4-3-2)

class MoviesController extends Controller
{
    // 4-3-1_動画新規作成画面
    public function create()
    {
        $user = \Auth::user();
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(6);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];

        return view('movies.create', $data);
    }

    // 4-3-2_動画登録機能
    // tinkerで用いたものと同様のコードで、storeアクションを形作っていきます。
    public function store(MovieRequest $request) 
    // MovieRequest;今までコントローラに直接書いていたバリデーションを、別ファイルに切り分ける役割を担っています
    // Laravelでバリデーション を切り分ける方法は「フォームリクエスト」と呼ばれます。(useの追記も必要←8行目)
    // MovieRequest $request は型指定の一種で、新規登録フォームから持ち込まれる値 $request が、
    // MovieRequestのバリデーションに合致するように制約を掛けているということです。
    // $ php artisan make:request MovieRequest
    // →「app/Http/Request/MovieRequest.php」が作成されます。
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->save();
        return back();
        // 「return back();」は、view() でviewを表示させる代わりに、メソッドの終わりに、
        // 直前に表示されていたviewを表示させる役割があります。
    }
    
    // 4-3-3_動画削除機能 →　destroyアクションの追加
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if (\Auth::id() === $movie->user_id) {
            $movie->delete();
        }
        return back();
        //findOrFail() ー find()はLaravelに最初から存在するidによって一致するレコードを検索するメソッドですが、
        // findOrFail()はfind()と同様の検索機能と合わせて、万一IDが存在しないレコードを検索した場合に
        // 「見つからない」旨のエラー画面を自動で表示してくれる便利なメソッドです。
        // また、削除は消してしまうリスクも伴う行為なので、念のためにAuthファサードを使って、
        // ログインしているユーザのIDと動画の所有者ユーザIDが一致するときのみ実行されるように書いています。
        // この後は、Viewで削除ボタンを追記していきます。（ → resources/views/movies/movies.blade.php）
    }

}
