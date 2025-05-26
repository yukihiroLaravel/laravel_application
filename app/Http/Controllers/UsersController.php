<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 追記

class UsersController extends Controller
{
    public function index()
    {
        // データベースからユーザ一覧を取得し、IDが新しい順（降順）に並べる
        $users = User::orderBy('id','desc')->paginate(9);
         // ビューにユーザ一覧を渡す　→　ユーザー一覧を表示するviewを作成する
        return view('welcome', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        // ユーザIDをもとにユーザ情報を取得
        $user = User::findOrFail($id);
        // ユーザが投稿した動画を取得し、IDが新しい順（降順）に並べてページネーションする
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        // ユーザ情報と動画一覧を$dateに入れる
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        // ユーザが投稿した動画の数をカウントするメソッドを呼び出し、結果を$dataに追加
        // $this->userCounts($user) は、Controller.phpで定義したメソッド
        $data += $this->userCounts($user);
        // ユーザの詳細ページを表示するビューを返す
        return view('users.show',$data);
    }
}