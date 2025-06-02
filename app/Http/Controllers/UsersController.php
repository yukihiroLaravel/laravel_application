<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 追記


class UsersController extends Controller
// ユーザに関する処理を行うコントローラ
{
    // ユーザ一覧を表示するメソッド
    // indexメソッドは、ユーザ一覧を表示するためのメソッド
    public function index()
    {
        // データベースからユーザ一覧を取得し、IDが新しい順（降順）に並べる
        $users = User::orderBy('id','desc')->paginate(9);
         // ビューにユーザ一覧を渡す　→　ユーザー一覧を表示するviewを作成する
        return view('welcome', [
            'users' => $users,
        ]);
    }

    // ユーザの詳細を表示するメソッド
    // showメソッドは、特定のユーザの詳細を表示するためのメソッド
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

    // ユーザのお気に入り動画を表示するメソッド
    // favoritesメソッドは、特定のユーザのお気に入り動画を表示するためのメソッド
    public function favorites($id)
    {
        // ユーザIDをもとにユーザ情報を取得
        // findOrFailメソッドは、指定したIDのユーザが存在しない場合に404エラーを返す
        $user = User::findOrFail($id);
        // ユーザがいいねした動画を取得し、表示（ページネーション）する
        // favorites()メソッドは、Userモデルで定義された多対多のリレーションを使用して、お気に入り動画を取得
        $movies = $user->favorites()->paginate(9);
        // ユーザ情報とお気に入り動画一覧を$dataに入れる
        // $dataは、ビューに渡すデータを格納する配列
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        // controller.phpで定義したuserCountsメソッドを呼び出し、
        // ユーザが投稿した動画の数をカウントして上で定義した$dataに追加
        // $this->userCounts($user) は、ユーザが投稿した動画の数をカウントするメソッド
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }
}