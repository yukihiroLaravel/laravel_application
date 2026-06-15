<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {

        // ユーザーを全件取得し、orderByという関数でidの降順（新しい順）に並び替える
        // 1ページ9件表示
        $users = User::orderBy('id', 'desc')->paginate(9);

        // welcome.blade.php というviewファイルを返す
        // 配列の形で渡すのが一般的
        // 'users'は何でもOK。welcome.blade.phpで使用する名前を指定する。
        return view('welcome', [
            'users' => $users,
        ]);
    }

    // ユーザ詳細画面を表示
    public function show($id)
    {
        // 1. URLのIDでユーザーを取得
        // findOrFail()：ユーザーがなければエラーになる関数
        $user = User::findOrFail($id);

        // 2. そのユーザーがいいねした動画一覧を9件ずつ取得
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);

        // 3. ビューに渡すデータを配列で用意
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);

        return view('users.show', $data);
    }

    // ユーザIDから、ユーザ詳細画面のタブの中に表示する、「お気に入り（いいね！）一覧」取得
    public function favorites($id)
    {
        // 1. URLのIDでユーザーを取得
        $user = User::findOrFail($id);

        // 2. そのユーザーがいいねした動画一覧を9件ずつ取得
        $movies = $user->favorites()->paginate(9);

        // 3. ビューに渡すデータを配列で用意
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];

        // userCounts($user) は Controller.php で定義されている
        // 例：
        // return [
        //     'countMovies'    => 3,   // その人が投稿した動画数
        //     'countFavorites' => 7,   // その人がいいねした動画数
        // ];
        // $data += の後の、$data の中身
        // $data = [
        //     'user'           => $user,    // 元からあったもの
        //     'movies'         => $movies,  // 元からあったもの
        //     'countMovies'    => 3,        // ← userCounts() から追加された
        //     'countFavorites' => 7,        // ← userCounts() から追加された
        // ];
        $data += $this->userCounts($user);
        
        return view('users.show', $data);
    }
}
