<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('name', 'LIKE', "%{$request->search}%")
                    ->paginate(9);

        $movies = Movie::where('title', 'LIKE', "%{$request->search}%")
                    ->orWhere('youtube_id', 'LIKE', "%{$request->search}%")
                    ->paginate(9);

        return view('welcome', [
            'users' => $users, 'movies' => $movies,
        ]);

    }
}
