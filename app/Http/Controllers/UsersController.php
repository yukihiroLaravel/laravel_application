<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(9);
        //paginateとは1ページに表示させるのは９つの動画までという記述

        return view('welcome', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $movies = $user->movies()->orderBy('id','desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this -> userCounts($user);

        return view('users.show',$data);
    }

}
