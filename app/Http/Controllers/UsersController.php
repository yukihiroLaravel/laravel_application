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
}
