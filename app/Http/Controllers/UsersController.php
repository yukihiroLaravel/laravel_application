<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(9);//orderBy並び替え(idをdesc新しい順に並び替え)　　paginateページ送り(9こまで表示)
        return view('welcome', [//welcomeに$usersを持っていく
            'users' => $users,//配列で持っていく
        ]);
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data =[
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);
        
        return view('users.show', $data);
    }  
}
