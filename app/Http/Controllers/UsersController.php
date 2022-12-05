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
}
