<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(9);
        return view('welcome', ['users' => $users,]);
    }
}

// 関数indexを返すコントローラー
// viewフォルダ内のwelcome.blade.phpファイルの内容をHTML生成する