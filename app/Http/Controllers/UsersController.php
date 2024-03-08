<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function indexUsers(Request $request)
    {
        if ($request->has('search_word')) {
            $search_word = $request->search_word;
            $query = User::query();
            $spaceConversion = mb_convert_kana($search_word, 's');
            $wordArraysearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($wordArraysearched as $value) {
                $query->where('name', 'LIKE', '%' . $value . '%');
            }

            $users = $query->orderBy('id', 'desc')->paginate(9);

            return view('welcome', [
                'users' => $users,
                'search_word' => $search_word,
            ]);
        } else {
            $users = User::orderBy('id', 'desc')->paginate(9);

            return view('welcome', [
                'users' => $users,
            ]);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);

        return view('users.show', $data);
    }

    public function favorites($id)
    {
        $user = User::findOrFail($id);
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
        $user = Auth::user();
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $current_email = $user->email;
        $current_icon = $user->icon;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['image', 'mimes:png,jpg,jpeg'],
            'new_email' => ['bail', 'required', 'string', 'email:filter', 'max:255', Rule::unique('users', 'email')->whereNot('email', $current_email)->whereNull('deleted_at')],
        ]);


        if (request()->file('icon')) {
            $new_icon = request()->file('icon')->store('public/images');
            $new_icon = str_replace('public/images', '', $new_icon);

            if ($current_icon !== '/user_icon_default.png') {
                // 現在の画像ファイルの削除
                Storage::disk('public')->delete('images' . $current_icon);
            }
        } else {
            if ($request->icon_status == 'default_icon') {
                $new_icon = '/user_icon_default.png';

                if ($current_icon !== '/user_icon_default.png') {
                    Storage::disk('public')->delete('images' . $current_icon);
                }
            } elseif ($request->icon_status == 'current_icon') {
                $new_icon = $current_icon;
            }
        }

        $user->name = $request->name;
        $user->email = $request->new_email;
        $user->icon = $new_icon;
        $user->save();

        $id = $user->id;

        return redirect()->route('user.show', $id)->with('status', 'ユーザー情報を変更しました');
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
