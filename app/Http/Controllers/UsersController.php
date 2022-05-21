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
}
