<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Movie;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }
    
    public function store(Request $request, Movie $movie)
    {
       // バリデーション
       $request->validate([
           'comment' => 'required|max:255',
           'movie_id' => 'required|exists:movies,id',
       ]);

       // コメントの保存
       $comment = new Comment;
       $comment->comment = $request->comment;
       $comment->movie_id = $request->input('movie_id');
       $comment->user_id = Auth::user()->id;
       $comment->save();
        return redirect()->back()->with('success', 'コメントが投稿されました');
    }

    public function destroy($id)
    {
       $comment = Comment::findOrFail($id);

        // 所有者チェック：ログインユーザー以外は403エラー
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'このコメントを削除する権限がありません。');
        }

        // コメント削除
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'コメントを削除しました。');
    }

    public function edit($id)
    {
        $user = Auth::user();
        // コメントの所有者を取得
        $comment = Comment::where('id', $id)
                          ->where('user_id', $user->id)
                          ->first();

        if (!$comment) {
            abort(404, 'コメントが見つかりません');
        }

        return view('comment.edit', [
            'comment' => $comment,
            'user' => $user,
            'movie' => $comment->movie, // コメントに関連する動画情報も渡す
        ]);
    }

    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'comment' => 'required|max:255',
        ]);

        $comment = Comment::findOrFail($id);
        // コメントの所有者が現在のユーザでない場合、エラーを返す
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'コメントの編集権限がありません');
        }
        // コメントの更新処理
        // リクエストから取得したコメントを更新
        $comment->comment = $request->comment;
        $comment->save();
        
        return back();
    }

}
