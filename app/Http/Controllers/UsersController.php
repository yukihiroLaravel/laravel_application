<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        //viewファイルの'welcome.blade.php'を返却(return)する
        return view('welcome');
    }
}
