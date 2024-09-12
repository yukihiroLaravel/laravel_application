<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    // トップページ（動画一覧）の表示
    public function index(){
        $users = User::orderBy('id','desc')->paginate(9);
        return view('welcome', ['users' => $users]);
    }

    // ユーザー詳細ページの表示
    public function show($id){
        $user = User::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }

    // お気に入り一覧の表示
    public function favorites($id){
        $user = User::findOrFail($id);
        $movies = $user->favorites()->paginate(9);
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }
}
