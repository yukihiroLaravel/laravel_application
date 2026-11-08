<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(9); //orderBy　データを並び替える関数　('id','desc')　idを新しい順に並べる　昇順（asc）降順（desc）
        //　paginate(9); 9コまでのデータを取得する※10コのデータだったら1コは次のページへ
        return view('welcome', [    //　[配列]　配列を使って　welcome.blade.phpに変数$userを持ち込んでviewに渡す         
            'users' => $users,
        ]);
    }
}
