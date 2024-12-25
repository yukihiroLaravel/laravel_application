<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userCounts($user) //userCountメソッド(引数、対象のuser)
    {
        $countMovies = $user->movies()->count(); //対象のユーザー動画数を取得
        $countFavorite = $user->favorites()->count(); //対象のユーザーのお気に入り数を取得
        return[
            'countMovies' => $countMovies, //カウントした動画数を返却
            'countFavorites' => $countFavorite, //カウントしたお気に入り数を返却
        ];
    }
}
