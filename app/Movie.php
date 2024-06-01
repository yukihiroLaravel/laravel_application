<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;

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
}