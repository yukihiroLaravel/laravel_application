<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{

    /**
     * 各ユーザが所有している動画を1つだけトップページに表示する
     * 「ユーザ一覧」
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(9);

        return view('welcome', [
            'users' => $users,
        ]);
    }
}
