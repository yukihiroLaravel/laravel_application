<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(9);
        // view上に変数を持っていく時は配列を使う
        return view('welcome', [
            'users' => $users,
        ]);
    }
}
