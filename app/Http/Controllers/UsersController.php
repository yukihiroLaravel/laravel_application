<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;


class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(9);

        //追加
        //$countComments = Comment::count();

        return view('welcome', [
            'users' => $users,
            //追加
            //'countComments' => $countComments,
        ]);
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

    //ユーザープロファイル
    //View
    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];
        $data += $this->userCounts($user);
        return view('profile.showProfile', $data);
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nickname' => 'required|string|max:255|unique:users,nickname,' . auth()->id(),
            'gender' => 'required|in:male,female,other,unknown',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB以下の画像
            'self_introduction' => 'nullable|string',
        ]);

        $user = auth()->user();
        $user->nickname = $request->nickname;
        $user->gender = $request->gender;
        $user->self_introduction = $request->self_introduction;

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('profile.showProfile',  ['id' => $user->id])->with('success', 'プロフィールが更新されました');
    }

    public function deletePicture(Request $request)
    {
        $user = auth()->user();

        if ($user->profile_picture) {
            // ストレージからファイルを削除
            Storage::delete('public/' . $user->profile_picture);

            // データベースのエントリを更新
            $user->profile_picture = null;
            $user->save();

            return redirect()->back()->with('success', 'プロファイル写真が削除されました。');
        }

        return redirect()->back()->with('error', '写真が見つかりませんでした。');
    }

    public function uploadPicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        // 古い画像を削除
        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }

        // 新しい画像を保存
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $path),
        ]);
    }
}
