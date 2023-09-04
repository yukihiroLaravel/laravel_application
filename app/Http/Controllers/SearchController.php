<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class SearchController extends Controller
{
    public function create() 
    {
        return view('search.create');
    }

    public function search(Request $request)
    {
        $keyword = '%'.$request->input('keyword').'%';
        $query = Movie::query();

        if (!empty($keyword)) {
            $query->where('title', 'LIKE', $keyword);
        }

        $movies = $query->get();
        // DBファザードを使う方法：こちらはモデルを使わずダイレクトにアクセス
        // if(!empty($keyword)) {
        //     $movies = DB::table('movies')->where('title', 'LIKE', $keyword)->get();
        // }

        return view('search.search', ['movies' => $movies]);
    }
}
