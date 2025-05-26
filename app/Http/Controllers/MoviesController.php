<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{
    public function create()
    {
        $user = \Auth::user();
        $movies = $user->movies()->orderBy('created_at', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,                
        ];
        return view('movies.create', $data);
    }

    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->title = $request->title;
        $movie->youtube_id = $request->youtube_id;
        $movie->user_id = $request->user()->id;
        $movie->save();
        return back();
    }

    public function destroy(int $id)
    {
    $movie = Movie::findOrFail($id);
    if(\Auth::id() === $movie->user_id)
    {
        $movie->delete();
    }
    return back();
    }
};
?>