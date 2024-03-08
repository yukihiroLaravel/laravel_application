<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest;
use App\Hashtag;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('id', 'desc')->paginate(9);

        return view('welcome', [
            'movies' => $movies,
        ]);
    }

    public function indexMovies(Request $request)
    {
        if ($request->has('search_word')) {
            $search_word = $request->search_word;
            $query = Movie::query();
            $spaceConversion = mb_convert_kana($search_word, 's');
            $wordArraysearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($wordArraysearched as $value) {
                $query->where('title', 'LIKE', '%' . $value . '%');
            }

            $movies = $query->orderBy('id', 'desc')->paginate(9);

            return view('welcome', [
                'movies' => $movies,
                'search_word' => $search_word,
            ]);
        } else {
            $movies = Movie::orderBy('id', 'desc')->paginate(9);

            return view('welcome', [
                'movies' => $movies,
            ]);
        }
    }

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

    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;

        if ($request->title) {
            $movie->title = $request->title;
        } else {
            $keyName = config('app.YouTubeDataApiKey');
            $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
            $jsonData = file_get_contents($apiUrl);
            if ($jsonData) {
                $decodedData = json_decode($jsonData, true);
                if ($decodedData['pageInfo']['totalResults'] !== 0) {
                    $movie->title = $decodedData['items']['0']['snippet']['title'];
                }
            }
        }
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->user_id = $request->user()->id;
        $movie->save();

        if ($request->hashtags) {
            $hashtags = str_replace('＃', '#', $request->hashtags);
            preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/', $hashtags, $arrayTags);

            foreach ($arrayTags[1] as $tag) {
                if (DB::table('hashtags')->where('name', $tag)->exists()) {
                    $hashtag = DB::table('hashtags')->where('name', $tag)->first();
                } else {
                    $hashtag = new Hashtag;
                    $hashtag->name = $tag;
                    $hashtag->save();
                }
                $movie->hashtags()->attach($hashtag->id);
            };
        }

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

    public function edit($id)
    {
        $user = \Auth::user();
        $movie = Movie::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movie' => $movie,
            'movies' => $movies,
        ];

        return view('movies.edit', $data);
    }

    public function update(MovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->youtube_id = $request->youtube_id;

        if ($request->title) {
            $movie->title = $request->title;
        } else {
            $keyName = config('app.YouTubeDataApiKey');
            $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
            $jsonData = file_get_contents($apiUrl);
            if ($jsonData) {
                $decodedData = json_decode($jsonData, true);
                if ($decodedData['pageInfo']['totalResults'] !== 0) {
                    $movie->title = $decodedData['items']['0']['snippet']['title'];
                }
            }
        }

        $movie->user_id = $request->user()->id;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->save();

        if ($request->hashtags) {
            $hashtags = str_replace('＃', '#', $request->hashtags);
            preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/', $hashtags, $arrayTags);
            $movie->hashtags()->detach();
            foreach ($arrayTags[1] as $tag) {
                if (DB::table('hashtags')->where('name', $tag)->exists()) {
                    $hashtag = DB::table('hashtags')->where('name', $tag)->first();
                } else {
                    $hashtag = new Hashtag;
                    $hashtag->name = $tag;
                    $hashtag->save();
                }
                $movie->hashtags()->attach($hashtag->id);
            }
        }

        return back();
    }
}
