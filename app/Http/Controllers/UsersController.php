<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}

// 関数indexを返すコントローラー
// viewフォルダ内のwelcome.blade.phpファイルの内容をHTML生成する