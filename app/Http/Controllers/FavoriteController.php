<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class FavoriteController extends Controller
{
    public function store($id)
    {
        // ユーザが動画をお気に入り登録するためのメソッド
        // \Auth::user()は現在ログインしているユーザを取得
        // favoriteメソッドは、ユーザが指定した動画IDをお気に入りに追加する
        // ここでは、動画IDを引数として受け取り、ユーザのお気に入りに追加する
        // \Auth::user()->favorite($id)は、ユーザが指定した動画IDをお気に入りに追加する
        \Auth::user()->favorite($id);
        // お気に入り登録後、元のページに戻る
        // back()メソッドは、リクエスト元のページにリダイレクトする
        return back();
    }
    public function destroy($id)
    {
        // ユーザが動画をお気に入り解除するためのメソッド
        // \Auth::user()は現在ログインしているユーザを取得
        // favoriteメソッドは、ユーザが指定した動画IDをお気に入りに追加する
        // ここでは、動画IDを引数として受け取り、ユーザのお気に入りに追加する
        // \Auth::user()->unfavorite($id)は、ユーザが指定した動画IDのお気に入りを解除する
        \Auth::user()->unfavorite($id);
        // お気に入り解除後、元のページに戻る
        // back()メソッドは、リクエスト元のページにリダイレクトする
        return back();
    }
}