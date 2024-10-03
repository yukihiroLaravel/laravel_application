<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller 
{
    
    public function index(){
        $users = User::orderBy('id','desc')->paginate(9);//ユーザーIDを新規順で9つ表示される。10以降は次ページになる。
        return view("welcome", ['users'=>$users]);//取得したユーザーリスト(ID)をwelcomeビューに渡しそのビュー内でユーザーリストを表示する。
    }

    public function show($id)//ユーザー情報を表示する。
    {
        $user = User::findOrFail($id);//Userテーブルからidを取得。
        $movies = $user->movies()->orderBy('id','desc')->paginate(9);//ユーザーの所有する動画をidの降順で９つ表示。
        $data=[//dataに入れるユーザーidと所有する動画の準備。
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);//dataにユーザー情報を追加していく。
        return view('users.show',$data);//上記の情報をshow.blade.phpに渡す。
    }

    public function favorites($id)
    {
        $user = User::findOrFail($id);// Userモデルから指定されたidを取得する。なければ404エラーを返す。
        $movies = $user->favorites()->paginate(9);//ユーザーがいいねした動画を中間テーブルを介して取得する。
        $data=[ //上記のデータを配列にしてdataに入れる。
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);//userCountsには動画数といいね数が入っておりそれを$dataに追加していく。
        return view('users.show',$data);//$dataをshow.blade.phpに渡す。
    }
}
