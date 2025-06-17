<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // ユーザの動画数をカウントするメソッド
    // このメソッドは、ユーザが持っている動画の数をカウントし、配列で返す
    // contoller.phpに記述することで、他のコントローラからも再利用できるようにする
    // 例えば、ユーザのプロフィールページやダッシュボードなどで、ユーザが持っている動画の数を表示する際に使用できる
    public function userCounts($user)
    {
        // ユーザが持っている動画の数をカウントする
        // $userは、Userモデルのインスタンスで、ユーザ情報を持っている
        $countMovies = $user->movies()->count();
        // ユーザがいいね！した動画の数をカウントする
        // $user->favorites()は、Userモデルのfavoritesリレーションを呼び出し、ユーザがいいね！した動画のコレクションを取得する
        $countFavorites = $user->favorites()->count();
        return [
            'countMovies' => $countMovies,
            'countFavorites' => $countFavorites,
        ];
    }
}
