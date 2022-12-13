<?php //新しくコントローラが作成されました。

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 追記
class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(9);
        return view('welcome', [
            'users' => $users,
        ]);
    }
}
