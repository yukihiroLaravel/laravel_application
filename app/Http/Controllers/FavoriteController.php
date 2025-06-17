<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // ルーティングで指定された動画IDを引数として受け取り、現在ログインしているユーザーがその動画にいいね！をする
    public function store($id)
    {
        \Auth::user()->favorite($id);
        return back();
    }

    // ルーティングで指定された動画IDを引数として受け取り、現在ログインしているユーザーがその動画にいいね！を解除する
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return back();
    }
}