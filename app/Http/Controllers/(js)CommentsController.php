<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Movie;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    // コメント一覧表示
    public function index($id)
    {
        $movie = Movie::findOrFail($id);
        $comments = $movie->comments()->with('user')->get();

        return view('movies.comments', [
            'movie' => $movie,
            'comments' => $comments,
        ]);
    }

    // コメント投稿
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        //(廃棄)return redirect()->route('movies.comments', $id)->with('success', 'コメントを投稿しました！');
        $comments = $movie->comments()->with('user')->get();
        $commentsHtml = view('partials.comments', compact('comments'))->render();

        return response()->json(['success' => true, 'comments_html' => $commentsHtml]);
    }


    // コメント編集
    //public function update(Request $request, $id, $comment_id)
    //{
        //$request->validate([
            //'content' => 'required|string|max:500',
        //]);

        //$comment = Comment::where('movie_id', $id)->findOrFail($comment_id);

        //if ($comment->user_id !== auth()->id()) {
            //abort(403, '権限がありません。');
        //}

        //$comment->update(['content' => $request->content]);

        //return redirect()->route('movies.comments', $id)->with('success', 'コメントを編集しました！');
    //}

    public function update(Request $request, $movieId, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = Comment::findOrFail($commentId);

        if (auth()->id() === $comment->user_id) {
            $comment->update(['content' => $request->input('content')]);

            $comments = Comment::where('movie_id', $movieId)->with('user')->get();
            $commentsHtml = view('partials.comments', compact('comments'))->render();

            return response()->json([
                'success' => true,
                'comments_html' => $commentsHtml,
            ]);
        }

        return response()->json(['success' => false], 403);
    }

    // コメント削除
    //public function destroy($id, $comment_id)
    //{
    //$comment = Comment::where('movie_id', $id)->findOrFail($comment_id);

    //if ($comment->user_id !== auth()->id() && $comment->movie->user_id !== auth()->id()) {
    //abort(403, '権限がありません。');
    //}

    //$comment->delete();

    //return redirect()->route('movies.comments', $id)->with('success', 'コメントを削除しました！');
    //}

    public function destroy($movieId, $commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (auth()->id() === $comment->user_id || auth()->id() === Movie::findOrFail($movieId)->user_id) {
            $comment->delete();

            $comments = Comment::where('movie_id', $movieId)->with('user')->get();
            $commentsHtml = view('partials.comments', compact('comments'))->render();

            return response()->json([
                'success' => true,
                'comments_html' => $commentsHtml,
            ]);
        }

        return response()->json(['success' => false], 403);
    }
}
