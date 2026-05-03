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

    // user詳細画面を表示
    public function show($id)
    {
        // findOrFail()：ユーザーがなければエラーになる関数
        $user = User::findOrFail($id);

        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);

        return view('users.show', $data);
    }
}
