<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store($id)
    {
        \Auth::user()->favorite($id);//ログインしたユーザーがいいねをする。
        return back();//いいねしたら直前のページにリダイレクトする。
    }
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);//ログインしたユーザーがいいねを外す(削除する)。
        return back();//いいねを削除したら直前のページにリダイレクトする。
    }
}
