<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{

    public function index()
    {
        // ユーザー情報を取得し、降順にソート、9つずつで改ページ
        $users = User::orderBy('id', 'desc')->paginate(9);

        // welcome.blade.php というviewファイルを返す
        // 変数usersを'users'という名前の配列でビューに渡す
        return view('welcome',
        [
            'users' => $users,
        ]);
    }
}