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
        $countMovies = $user->movies()->count();
        // 特定のユーザがいいね！をした動画の数を取得
        $countFavorites = $user->favorites()->count();

        return [
            'countMovies' => $countMovies,
            'countFavorites' => $countFavorites,
        ];
    }
}
