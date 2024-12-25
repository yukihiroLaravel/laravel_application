<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    // indexメソッド
    {
        $users = User::orderBy('id', 'desc')->paginate(9);
        //userクラス（テーブル）からデータを取得してidカラムを降順に並び替え、9件ずつのページネーションを設定
        return view('welcome', ['users' => $users]);
        //welcomeビューにデータを渡す　usersキーで$usersを使用可能
    }

    public function show($id)
    //showメソッド
    {
        $user = User::findOrFail($id);
        //userクラス（テーブル）から指定されたidを検索、存在しなければエラー処理
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        //対象userが投稿した動画(movieテーブル)を取得しidカラムの降順に並び替え、９件ずつのページネーションを設定
        $data = [
            'user' => $user,
            // userキーで$userを格納
            'movies' => $movies,
            // moviesキーで$moviesを格納
        ];
        $data += $this->userCounts($user);
        // $dataにユーザーの投稿動画数、お気に入り数を追加(userContes->Controller.php内)
        return view('users.show', $data);
        //usesフォルダのshowビューに$dataを渡す
    }

    public function favorites($id)
    {
        //favoritesメソッド
        $user = User::findOrFail($id);
        //userクラス（テーブル）から対象ユーザーのidを検索 存在しなければエラーを返却
        $movies = $user->favorites()->paginate(9);
        //対象ユーザーのお気に入りを取得(favoritesフォルダ)し９つずつのページネーションを設定
        $data = [
            'user' => $user,
            //userをキーに$userを格納
            'movies' => $movies,
            //moviesをキーにmoviesを格納
        ];
        $data += $this->userCounts($user);
        //$dataに対象ユーザーの投稿動画数、お気に入り数を追加
        return view('users.show', $data);
        //usesフォルダのshowビューに$dataを渡す

    }
}
