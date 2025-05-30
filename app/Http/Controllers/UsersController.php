<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = User::orderBy('id','desc')->paginate(9);
        return view('welcome',[
            'users' => $users
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);
        return view('users.show',$data);
    }
    
    // web.phpから受け取ったidを引数に入れる
    public function favorites($id)
    {
        $user = User::findOrFail($id);
        $movies = $user->favorites()->paginate();
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);
        return view('users.show',$data);
        }
}