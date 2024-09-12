<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // お気に入り登録を実行
    public function store($id){
        \Auth::user()->favorite($id);
        return back();
    }

    // お気に入り解除を実行
    public function destroy($id){
        \Auth::user()->unfavorite($id);
        return back();
    }
}
