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

    /**
     * 
     */
    public function show($id)
    {
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
