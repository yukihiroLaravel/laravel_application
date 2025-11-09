<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {                              //asc=古い順　desc=新しい順
        $users = User::orderBy('id','desc')->paginate(9);

        return view('welcome', [
            'users' => $users,
        ]);
    }
}
