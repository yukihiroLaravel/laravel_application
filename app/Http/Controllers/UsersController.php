<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(9);
        //orderBy=順番を並び替える関数
        //orderBy(カラム名, 並び替える順番)
        //'desc'=新しい順、'asc'=古い順

        //paginate=ページ送り機能
        //ここでは(9)とあるので、1ページ目では９個まで表示するという意味

        return view('welcome', [
            'users' => $users,
        ]);
        // UsersControllerからviewのwelcome.blade.phpでにいくんだけど、と第２引数に ['users' => $users,]と入れることにより、welcome.blade.phpでも、$usersの変数(中身を含めたもの)が使用できる、という意味
    }
}
