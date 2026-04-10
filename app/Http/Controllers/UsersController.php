<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index(){
       //ユーザをidの降順（新しい順）で取得　第一引数はカラム名、第二引数は順番 
       $users = User::orderBy('id', 'desc')->paginate(9);
       //welcome.blade.phpにusersを渡す　第一引数はviewのファイル名、第二引数はviewに渡すデータを配列で指定
       return view('welcome',[
           'users' => $users,
       ]);
    }

    public function show($id)
    {
        $user = User::findOrfail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }
}
