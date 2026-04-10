<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //ユーザが持っている動画数を表示させるためのメソッド ここで定義することで、他のコントローラーでも使用できるようになる
    public function userCounts($user)
    {
        $countMovies = $user->movies()->count();
        
        return [
            'countMovies' => $countMovies,
        ];
    }
}
