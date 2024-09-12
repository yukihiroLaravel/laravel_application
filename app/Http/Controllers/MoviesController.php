<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest;


class MoviesController extends Controller
{
    // 動画登録ページの表示
    public function create(){
        $user = \Auth::user();
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        return view('movies.create', $data);
    }

    // 動画登録を実行
    public function store(MovieRequest $request){
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->save();
        return back();
    }

    // 動画削除を実行
    public function destroy($id){
        $movie = Movie::findOrFail($id);
        if(\Auth::id() === $movie->user_id){
            $movie->delete();
        }
        return back();
    }

    // 動画編集ページの表示
    public function edit($id){
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

    // 動画情報の編集を実行
    public function update(MovieRequest $request, $id){
        $movie = Movie::findOrFail($id);
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->favorite_flag = $request->favorite_flag = $request->favorite_flag ? 1 : 0;
        $movie->save();
        return back();
    }
}
