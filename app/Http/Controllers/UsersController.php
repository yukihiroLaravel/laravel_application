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

// viewファイル内のwelcomeなる名前のviewファイルを、return関数の返り値として返す。
   // welcomeなるviewファイルのURL： welcome.blade.phpというファイル。
