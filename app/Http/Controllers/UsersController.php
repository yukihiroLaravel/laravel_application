<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // view()で引数のファイルを表示するという意味　viewファイルを返却するの意味
        // これでいけばwelcome.balade.phpになる　view()内に記述すれば、.blade.phpは省略できる
        return view('welcome');
    }
}
