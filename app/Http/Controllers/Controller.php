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
        $countMovies = $user->movies()->count();//ユーザーが所有している動画の数をカウントする。
        $countFavorites = $user->favorites()->count();//ユーザーがいいねしている数をカウントする。
        return[
            'countMovies' => $countMovies,//動画数を返す
            'countFavorites' => $countFavorites,//いいね数を返す。
        ];
    }
    
}
