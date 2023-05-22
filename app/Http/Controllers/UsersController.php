<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 追記

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(9); 
        //orderBy:laravel備え付けの順番を並び変える関数で、1つ目の引数'id'カラムのidを
        //desc（新しい順）に並び替える
        //paginate(9):ページずつデータを取得する、9つを超えるデータは2ページ目に表示
        return view('welcome', [
            'users' => $users,
        ]); //$users情報をviweに持っていく
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);
        
        return view('users.show',$data);
    }
}
