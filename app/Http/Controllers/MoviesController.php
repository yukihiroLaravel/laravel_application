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

    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        $comments = $movie->comments()
            ->whereNull('parent_id') // parent_id が Null、つまり親コメントだけに絞る
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        return view('movies.show', [
            'movie' => $movie,
            'comments' => $comments,
        ]);        
    }

    public function search(Request $request)
    {
        // $request->validate([
        //     'keyword' => 'nullable|string|max:255',
        // ]);
        
        $keyword = trim($request->input('keyword'));

        if (empty($keyword)) {
            $movies = Movie::orderBy('id', 'desc')->paginate(9);
        } else {
            $movies = Movie::where('title', 'like', '%' . $keyword . '%')
                ->orderBy('id', 'desc')
                ->paginate(9);
        }

        return view('movies.search', [
            'keyword' => $keyword,
            'movies' => $movies,
        ]);
    }

    private function getYoutubeTitle($youtubeId)
    {
        $videoTitle = null;

        if (!empty($youtubeId)) {
            $keyName = config('app.YouTubeDataApiKey');
            $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$youtubeId}&key={$keyName}&part=snippet";

            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $apiUrl);
            $jsonData = $response->getBody()->getContents();

            if ($jsonData) {
                $decodedData = json_decode($jsonData, true);

                if ($decodedData['pageInfo']['totalResults'] !== 0) {
                    $videoTitle = $decodedData['items']['0']['snippet']['title'];
                }
            }
        }

        return $videoTitle;
    }

    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;

        if (!empty($request->title)) {
            $movie->title = $request->title;
        } else {
            $movie->title = $this->getYoutubeTitle($request->youtube_id);
        }

        $movie->user_id = $request->user()->id;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->save();

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

        if (!empty($request->title)) {
            $movie->title = $request->title;
        } else {
            $movie->title = $this->getYoutubeTitle($request->youtube_id);
        }

        $movie->user_id = $request->user()->id;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->save();

        return back();
    }
}
