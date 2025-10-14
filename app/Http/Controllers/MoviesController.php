<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Request\MovieRequest;

class MoviesController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);

        return view('movies.create', [
            'user' => $user,
            'movies' => $movies,
        ]);
    }

    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = auth()->id();
        $movie->save();

        return back()->with('success', '動画を登録しました！');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        abort_unless(auth()->id() === $movie->user_id, 403);

        $movie->delete();

        return back()->with('success', '動画を削除しました！');
    }
}
