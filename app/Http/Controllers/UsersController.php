<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function show()
    {
        $user = User::find(Auth::id());
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);

        return view('users.show', $data);
    }

    public function favorites()
    {
        $user = User::find(Auth::id());
        $movies = $user->favorites()->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }

    public function edit()
    {
        $user = \Auth::user();
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $current_email = $user->email;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['image', 'mimes:png,jpg,jpeg'],
            'new_email' => ['bail', 'required', 'string', 'email:filter', 'max:255', Rule::unique('users', 'email')->whereNot('email', $current_email)->whereNull('deleted_at')],
        ]);

        if (request()->file('icon')) {
            $icon = request()->file('icon')->store('public/images');
            $icon = str_replace('public/images', '', $icon);
        } else {
            $icon = 'user_icon_default.png';
        }

        $user->name = $request->name;
        $user->email = $request->new_email;
        $user->icon = $icon;

        $user->save();

        return redirect()->route('user.show')->with('status', 'ユーザー情報を変更しました');
    }

    public function passwordEdit()
    {
        $user = \Auth::user();
        return view('users.password', [
            'user' => $user,
        ]);
    }

    public function passwordUpdate(Request $request)
    {
        $user = User::find(Auth::id());

        if (!password_verify($request->current_password, $user->password) || ($request->current_password == $request->password)) {
            if ($request->current_password == '') {
                return back()->withErrors('現在のパスワードが未入力です')->withInput();
            } elseif (!password_verify($request->current_password, $user->password)) {
                return back()->withErrors('現在のパスワードが違います')->withInput();
            }
            if ($request->current_password == $request->password) {
                return back()->withErrors('現在のパスワードと新しいパスワードが同じです')->withInput();
            }
        } else {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('user.show')->with('status', 'パスワードの変更が終了しました');
        }
    }
}
