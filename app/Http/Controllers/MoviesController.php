<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest; // ✅ 修正

class MoviesController extends Controller
{
    public function create()
    {
        $user = \Auth::user();
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);

        return view('movies.create', [
            'user'   => $user,
            'movies' => $movies,
        ]);
    }

    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id    = $request->youtube_id;
        $movie->title         = $request->title;
        $movie->user_id       = $request->user()->id;
        $movie->favorite_flag = $request->boolean('favorite_flag'); // ✅ 統一
        $movie->save();

        return redirect()->route('movies.create')
                         ->with('success', '動画を登録しました');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if (\Auth::id() === $movie->user_id) {
            $movie->delete();
        }

        return redirect()->route('movies.create')
                         ->with('success', '動画を削除しました');
    }

    public function edit($id)
    {
        $user   = \Auth::user();
        $movie  = Movie::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);

        return view('movies.edit', [
            'user'   => $user,
            'movie'  => $movie,
            'movies' => $movies,
        ]);
    }

    public function update(MovieRequest $request, Movie $movie)
    {
        $this->authorize('update', $movie);

        $movie->update([
            'youtube_id'    => $request->youtube_id,
            'title'         => $request->title,
            'favorite_flag' => $request->boolean('favorite_flag'),
        ]);

        return redirect()->route('movies.edit', $movie->id)
                         ->with('success', '動画を更新しました');
    }
}