<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()  //追加　2023.09.23
    {
        return view('welcome');
    }
}
