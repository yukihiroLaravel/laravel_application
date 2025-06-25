<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Movie::query();
        // 検索キーワードを取得
        $keyword = $request->input('keyword');
        // キーワードが空でない場合、動画を検索
        if (isset($keyword) != '') {
            // Movieモデルのwhereメソッドを使用して、タイトルにキーワードが含まれる動画を取得
            $query->where('title', 'like', "%{$keyword}%")->orderBy('id', 'desc');
        } else {
            // キーワードが空の場合は、全ての動画を取得
            $query->orderBy('id', 'desc');
        }
        $searchmovies = $query->paginate(9);
        $data = [
            'searchmovies' => $searchmovies,
            'keyword' => $keyword,
        ];

        // ビューに渡すデータを配列で定義
        return view('movies.search', $data);
    }
}