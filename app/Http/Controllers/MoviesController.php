<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest;

class MoviesController extends Controller
{
    public function create()
    {
        $user = \Auth::user();
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        return view('movies.create', $data);
    }

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'nullable|string|max:255',
        ]);
        
        $keyword = trim($request->input('keyword'));

        if (empty($keyword)) {
            return view('movies.search', [
                'keyword' => $keyword,
                'movies' => null,
                'message' => '検索窓に値が入力されていません。'
            ]);
        }

        $movies = Movie::where('title', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('movies.search', [
            'keyword' => $keyword,
            'movies' => $movies,
            'message' => null,
        ]);
    }

    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->save();
        return back();
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if (\Auth::id() === $movie->user_id) {
            $movie->delete();
        }
        return back();
    }
}
