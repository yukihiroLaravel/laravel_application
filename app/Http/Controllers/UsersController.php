<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 追記

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(6);
        return view('welcome', [
            'users' => $users,
        ]);
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
        // userCounts関数をshowメソッドの$dataに足していきます。
        return view('users.show',$data);
        // 次は、Viewの調整で、ユーザ詳細画面で、ユーザ名の下に「タブ」を表示させ、「ユーザの動画情報一覧」や
        // 「いいね！した動画一覧」をタブによって切り替えられるようにします。
        // （resources/views/users/に、新規でshow.blade.phpを作成します）
    }
}
