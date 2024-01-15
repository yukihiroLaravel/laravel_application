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
        $user = \Auth::User();
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [ //ログインしているユーザー自身の情報と、ユーザー１人が所有している動画すべての情報が入っている
            'user' => $user,
            'movies' => $movies,
        ];
        return view('movies.create', $data);
    }

    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id; //$requestはcreateページのyoutube_idを打ち込んだ奴がここに入ってくる。それが$movieのyoutube_idとなる
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->save();
        return back();
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if(\Auth::id() === $movie->user_id){
            $movie->delete();
        }
        
        return back();
    }
}
