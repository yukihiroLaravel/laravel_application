<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // 追加: コントローラの基本クラス
    // 追加: AuthorizesRequests, DispatchesJobs, ValidatesRequestsトレイトを使用して、リクエストの認可、ジョブのディスパッチ、バリデーションを行う
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // ユーザが投稿した動画の数をカウントするメソッド
    // このメソッドは、ユーザが投稿した動画の数をカウントし、'countMovies'というキーで返す
    public function userCounts($user)
    {
        // ユーザが投稿した動画の数をカウントする
        // $user->movies() は、User モデルに関連付けられた Movie モデルのリレーションを取得するメソッド
        $countMovies = $user->movies()->count();
        $countFavorites = $user->favorites()->count();

        // ユーザが投稿した動画の数をカウントし、'countMovies'というキーで返す
        // ここでは、countMovies というキーで動画の数を返す
        return [
            'countMovies' => $countMovies,
            'countFavorites' => $countFavorites,
        ];
    }
}
