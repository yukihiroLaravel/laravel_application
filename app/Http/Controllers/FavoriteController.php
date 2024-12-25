<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store($id) //storeメソッド(引数、対象のid)
    {
        \Auth::user()->favorite($id); //ログイン中のユーザーで指定されたidでfavoriteメソッドを使用
        return back(); //画面更新
    }
    
    public function destroy($id) //destroyメソッドを使用
    {
        \Auth::user()->unfavorite($id); //ログイン中のユーザーで指定されたidでunfavoriteメソッドを使用
        return back(); //画面更新
    }

}
