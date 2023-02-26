<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        unset($users);
        return view('welcome', ['user' => $users]);
    }
}
