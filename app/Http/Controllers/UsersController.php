<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){

        // welcome.blade.php というviewファイルを返す
        return view('welcome');
    }
}
