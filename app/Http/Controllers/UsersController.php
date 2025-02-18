<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

cclass UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(9);
        return view('welcome', [
            'users' => $users,
        ]);
    }

}
