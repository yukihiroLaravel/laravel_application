<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Movie;
use App\Comment;

class CommentsController extends Controller
{

    public function create($id) 
    {

        $movie = Movie::findOrFail($id);
        $allComments = Comment::orderBy('created_at', 'desc')->paginate(5);
        $query = Comment::orderBy('id', 'desc');
        $user = \Auth::user();

        $data = [
            'user' => $user,
            'movie' => $movie,
            'comments' => $allComments
        ];
        return view('comments.create', $data);

    }

    public function comment(Request $request, $id)
    {
        $new_comment = new Comment;
        $movie = Movie::findOrFail($id);
        $user = \Auth::user();
        $comment = $request->input('new_comment', $request->comment);
        // use App\Comments が必要
        $new_comment->movie_id = $movie->id;
        $new_comment->user_id = $user->id;
        $new_comment->comment = $comment;
        // dd($new_comment);
        $new_comment->save();

        return back();
    }
}
