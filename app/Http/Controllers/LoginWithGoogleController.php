<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 追記
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginWithGoogleController extends Controller
{
    // 追加
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $gUser = Socialite::driver('google')->user();
            $user = User::where('email', $gUser->email)->first();
            $userGId = $user->google_id;
            if ($user == null) {
                $newUser = User::create([
                    'name' => $gUser->name,
                    'email' => $gUser->email,
                    'google_id' => $gUser->id,
                    'password' => encrypt('123456dummy'),
                    'icon' => '/user_icon_default.png',
                ]);
                Auth::login($newUser);
            } else {

                if ($userGId == null) {
                    $userGId = $gUser->id;
                }
                if ($userGId == $gUser->id) {
                    Auth::login($user);
                }
            }
            return redirect('/');
        } catch (Exception $e) {
            \Log::error($e);
            throw $e->getMessage();
        }
    }
}
