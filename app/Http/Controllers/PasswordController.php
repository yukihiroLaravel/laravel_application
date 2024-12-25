<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    // パスワード変更フォーム表示
    public function showChangePasswordForm()
    {
        return view('auth.changePassword');
    }

    // パスワード更新処理
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 現在のパスワードを確認
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
        }

        // パスワードを更新
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('status', 'パスワードが変更されました！');
    }
}
