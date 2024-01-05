<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('id', 'desc')->paginate(9);

        return view('welcome', [
            'movies' => $movies,
        ]);
    }

    public function indexSearch(Request $request)
    {
        $search_word = $request->search_word;

        if ($request->has('movie_search')) {

            $movies = Movie::orderBy('id', 'desc')->paginate(9);

            if ($request->has('search_word')) {
                $query = Movie::query();
                $spaceConversion = mb_convert_kana($search_word, 's');
                $wordArraysearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($wordArraysearched as $value) {
                    $query->where('title', 'LIKE', '%' . $value . '%');
                }
                $movies = $query->orderBy('id', 'desc')->paginate(9);
            }

            return view('welcome', [
                'movies' => $movies,
                'search_word' => $search_word,
                'movie_search' => 'movie_search',
            ]);
        } elseif ($request->has('user_search')) {

            $users = User::orderBy('id', 'desc')->paginate(9);

            if ($request->has('search_word')) {
                $query = User::query();
                $spaceConversion = mb_convert_kana($search_word, 's');
                $wordArraysearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($wordArraysearched as $value) {
                    $query->where('name', 'LIKE', '%' . $value . '%');
                }
                $users = $query->orderBy('id', 'desc')->paginate(9);
            }

            return view('welcome', [
                'users' => $users,
                'search_word' => $search_word,
            ]);
        }
    }

    public function indexSwitching(Request $request)
    {
        if ($request->has('index_movie')) {
            $movies = Movie::orderBy('id', 'desc')->paginate(9);

            return view('welcome', [
                'movies' => $movies,
            ]);
        }

        if ($request->has('index_user')) {
            $users = User::orderBy('id', 'desc')->paginate(9);

            return view('welcome', [
                'users' => $users,
            ]);
        }
    }
}
