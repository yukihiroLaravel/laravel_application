<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;

class VerificationController extends Controller
{
    // 認証リンクを送信する
    public function send(Request $request)
    {
        $user = Auth::user();

        if (!$user->email) {
            return back()->with('error', 'メールアドレスが設定されていません。');
        }

        // 認証リンク生成
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', 
            Carbon::now()->addMinutes(60), 
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // メール送信
        Mail::raw("以下のリンクをクリックして認証を完了してください: {$verificationUrl}", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('メールアドレス認証リンク');
        });

        return back()->with('success', '認証メールが送信されました。');
    }

    // 認証リンクの処理
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals(sha1($user->email), $hash) || !$request->hasValidSignature()) {
            abort(403, '無効な認証リンクです。');
        }

        $user->email_verified_at = now();
        $user->save();

        Session::flash('success', '認証成功しました。');
        return redirect()->route('profile.edit', ['id' => $user->id]);
    }
}
