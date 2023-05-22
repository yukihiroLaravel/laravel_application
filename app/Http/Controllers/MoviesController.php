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
        $movie->title = $request->title;
        $movie->user_id = $request->user()->id;
        $movie->save();
        return back();
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id); //findOrFail:id検索、idが存在しないと、見つかりません」等の表示する
        if (\Auth::id() === $movie->user_id) { //動画を削除しようとしているidとログインしているidが一致している場合のみ削除可能
            $movie->delete();
        }
        
        return back();
    }
}
