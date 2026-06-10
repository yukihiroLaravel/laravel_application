<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Comment;
use Auth;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
    public function store(CommentRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->movie_id = $movie->id;
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->route('movie.show', $movie->id);
    }

    public function storeReply(CommentRequest $request, $id)
    {
        $parentComment = Comment::findOrFail($id);

        $reply = new Comment();
        $reply->content = $request->content;
        $reply->movie_id = $parentComment->movie_id;
        $reply->user_id = Auth::id();
        $reply->parent_id = $parentComment->id;
        $reply->save();

        return redirect()
            ->route('movie.show', $parentComment->movie_id)
            ->with('open_comment_id', $reply->id);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $movieId = $comment->movie_id;

        $comment->delete();

        return redirect()->route('movie.show', $movieId);
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        return view('comments.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $comment->content = $request->content;
        $comment->save();

        return redirect()
            ->route('movie.show', $parentComment->movie_id)
            ->with('open_comment_id', $reply->id)
            ->with('success', '返信を投稿しました。');
    }
}