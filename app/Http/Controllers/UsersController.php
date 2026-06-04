<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //トップページのgetリクエストのアクション
    public function index()
    {
        return view('welcome');
    }
}