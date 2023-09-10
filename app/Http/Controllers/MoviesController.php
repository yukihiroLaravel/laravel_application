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

    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;

        $videoTitle="※動画が未登録です";
        if ($movie) {
            $keyName = config('app.YouTubeDataApiKey');
            $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
            $jsonData = file_get_contents($apiUrl);
            if ($jsonData) {
                $decodedData = json_decode($jsonData, true);
                if ($decodedData['pageInfo']['totalResults'] !== 0){
                    $videoTitle = $decodedData['items']['0']['snippet']['title'];
                }
            } else {
                $videoTitle="※一時的な情報制限中です";
            }
        }

        $movie->title = $videoTitle;
        $movie->user_id = $request->user()->id;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
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

    public function edit($id)
    {
        $user = \Auth::user();
        $movie = Movie::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data=[
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
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->save();
        return back();
    }
}
