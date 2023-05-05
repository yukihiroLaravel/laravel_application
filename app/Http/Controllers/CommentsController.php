<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\User;
use App\Comment;
use App\Http\Requests\CommentRequest;


class CommentsController extends Controller
{

    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }

    public function store(CommentRequest $request)
    {
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->movie_id = $request->movie_id;
        $comment->user_id = $request->user()->id;
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
