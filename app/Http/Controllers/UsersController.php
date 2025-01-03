<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Auth;


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

    public function update(UserEditRequest $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $user->nickname = $request->nickname;
        $user->gender = $request->gender;
        $user->self_introduction = $request->self_introduction;

        $deleteFlag = session()->pull("delete_picture_{$user->id}", false);

        if ($deleteFlag) {
            // 現在のプロファイル写真を削除
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            // データベースのフィールドをクリア
            $user->profile_picture = null;
        } else {
            // 一時ファイルが存在する場合は最終保存場所に移動
            $tempFiles = Storage::disk('public')->files("temp/{$user->id}");
            if (!empty($tempFiles)) {
                $tempFile = $tempFiles[0]; // 1つのファイルだけを扱うと仮定
                $finalPath = "profile_pictures/{$user->id}/" . basename($tempFile);
                Storage::disk('public')->move($tempFile, $finalPath);

                // データベースにパスを保存
                $user->profile_picture = $finalPath;
            }
        }

        $user->save();

        //return redirect()->back()->with('success', 'プロフィールが更新されました。');
        return redirect()->route('profile.showProfile', ['id' => $user->id])
            ->with('success', 'プロフィールが更新されました');
    }

    public function uploadTemp(Request $request)
    {
        // 認証されたユーザーを取得
        $user = auth()->user();

        // バリデーション
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            // 仮削除フラグをリセット
            session()->forget("delete_picture_{$user->id}");
            // ファイルをユーザーごとの一時ディレクトリに保存
            $file = $request->file('profile_picture');
            $path = $file->store("temp/{$user->id}", 'public');

            return response()->json([
                'success' => true,
                'imageUrl' => Storage::url($path),
            ]);
        }

        return response()->json(['success' => false, 'error' => 'ファイルのアップロードに失敗しました。']);
    }

    public function deleteTemp()
    {
        $user = auth()->user();

        // ユーザーの一時ディレクトリ内のファイルを削除
        $tempFiles = Storage::disk('public')->files("temp/{$user->id}");
        foreach ($tempFiles as $file) {
            Storage::disk('public')->delete($file);
        }
        // セッションに削除フラグを設定
        session()->put("delete_picture_{$user->id}", true);

        return response()->json(['success' => true]);
    }

    public function destroy()
    {
        $user = Auth::user(); // 現在の認証ユーザーを取得

        // 必要であれば関連データの削除処理も追加
        // $user->posts()->delete();  // 例: ユーザーの投稿データ削除

        $user->delete(); // ユーザー削除

        return redirect('/')->with('status', '退会が完了しました。ご利用ありがとうございました。');
    }
}
