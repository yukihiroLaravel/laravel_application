<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // 詳細画面でユーザーの所有している動画数を表示するメソッド
    public function userCounts($user)
    {
        $countMovies = $user->movies()->count();
        
        return [
            'countMovies' => $countMovies,
        ];
    }
}
