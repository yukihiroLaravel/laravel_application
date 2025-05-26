<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userCounts($user)
    {
        // ユーザが投稿した動画の数をカウントする
        // $user->movies() は、User モデルに関連付けられた Movie モデルのリレーションを取得するメソッド
        $countMovies = $user->movies()->count();
        // ユーザが投稿した動画の数をカウントし、'countMovies'というキーで返す
        // ここでは、countMovies というキーで動画の数を返す
        return [
            'countMovies' => $countMovies,
        ];
    }
}
