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
}