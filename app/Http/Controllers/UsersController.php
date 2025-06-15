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
}