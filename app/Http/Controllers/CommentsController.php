<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Comment;

class CommentsController extends Controller
{
    public function index($movie_id)
    {
        $movie = Movie::findOrFail($movie_id);

        return view('movies.movie', [
            'movie' => $movie,
        ]);
    }

    public function store(Request $request, $id)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->movie_id = $id;
        $comment->user_id = \Auth::user()->id;
        $comment->save();

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }
}
