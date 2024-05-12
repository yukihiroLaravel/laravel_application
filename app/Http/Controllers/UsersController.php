<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
   public function index()
   {
        $users = User::orderBy('id','desc')->paginate(9);

        return view('welcome',[
            'users' => $users,
        ]);
   }  
   // viewファイル内のwelcomeなる名前のviewファイルを、return関数の返り値として返す。
   // welcomeなるviewファイルのURL： welcome.blade.phpというファイル。

   public function show($id)
   {
      $user = User::findOrFail($id);
      $movies = $user->movies()->orderBy('id','desc')->paginate(9);
      $data=[
         'user' => $user,
         'movies' => $movies,
      ];
      $data += $this->userCounts($user);

      return view('users.show',$data);
   }
   public function favorites($id)
   {
      $user = User::findOrFail($id);
      $movies = $user->favorites()->paginate(9);
      $data = [
         'user' => $user,
         'movies' => $movies,
      ];
      $data += $this->userCounts($user);
      
      return view('users.show',$data);
   }
}


