<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 追記

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧を取得し、最新のユーザから9件ずつページ送りする
        // orderBy('id', 'desc')は、idの降順（新しい順）でソートすることを意味する
        $users = User::orderBy('id','desc')->paginate(9);
        // view()は、ビューを返すメソッドで、第一引数にビューの名前、第二引数にビューに渡すデータを配列で指定する
        // 第１引数のwelcome.blade.php に 第２引数の「$users」という変数を持っていく。
        // 'users'はビュー内で使用する変数名のため、任意の名前を付けることができる
        return view('welcome', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        // ユーザの詳細情報を取得
        // findOrFail()は、指定したIDのレコードを取得し、存在しない場合は404エラーを返すメソッド
        $user = User::findOrFail($id);
        // ユーザが持っている動画情報を取得し、最新の動画（降順）から9件ずつページ送りする
        // ユーザが持っている動画情報を取得するために、Userモデルのmovies()メソッドを使用
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        // ビューに渡すデータを配列で定義
        // 'user'はユーザ情報、'movies'はユーザが持っている動画一覧情報
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        // ユーザの動画数をカウントするメソッドを呼び出し、+=することで、$dataに追加
        // $thisはControllerのインスタンスを指し、userCounts()メソッドを呼び出す
        $data += $this->userCounts($user);
        // view()は、ビューを返すメソッドで、第一引数にビューの名前、第二引数にビューに渡すデータを配列で指定する
        // 'users.show'は、resources/views/users/show.blade.phpを指す
        return view('users.show',$data);
    }
}