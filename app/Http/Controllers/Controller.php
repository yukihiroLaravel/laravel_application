<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // 4-4_ユーザ詳細画面で、ユーザが所有している動画数を表示させます。
    // ここでは、userCountsというユーザ情報の算出メソッドをController.phpに
    // 新規作成することで、このメソッドをどのコントローラでも使えるように設定します。
    // 次のUsersControllerで扱いやすいように、配列の形式で動画数を返すようにします。
    // （続いて、showメソッドをUsersControllerに作成します。UsersControllerは、
    // 現在のControllerファイルを継承しています）
    public function userCounts($user)
    {
        $countMovies = $user->movies()->count();
        return [
            'countMovies' => $countMovies,
        ];
    }
}
