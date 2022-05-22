<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 追記して下さい

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(9);

        return view('welcome', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);

        return view('users.show', $data);
    }

    public function favorites($id)
    {
        $favoriteFlag = true;
        $user = User::find($id);
        $movies = $user->favorites()->paginate(9);
        $data=[
            'favoriteFlag' => $favoriteFlag,
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);

        return view('users.show', $data);
    }
}
