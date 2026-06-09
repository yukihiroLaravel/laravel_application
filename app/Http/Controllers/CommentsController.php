<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $movie = Movie::findOrFail($id);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->movie_id = $movie->id;
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->route('movie.show', $movie->id);
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('movie.show', $comment->movie_id);
    }
}