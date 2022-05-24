<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Http\Requests\MovieRequest;

class ApiController extends Controller
{
    const API_MOVIE_STORE_USER_ID = 1;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 200,
            'movies' => $movies,
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        if (is_null($movie)) {
            return response()->json([
                'status' => 400,
                'message' => '動画の取得に失敗しました。',
            ]); 
        }

        return response()->json([
            'status' => 200,
            'movie' => $movie,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;

        $user = User::find(self::API_MOVIE_STORE_USER_ID);
        if (is_null($user)) {
            return response()->json([
                'status' => 400,
                'message' => '動画を保存できるユーザが存在しません。',
            ]); 
        }
        $movie->user_id = self::API_MOVIE_STORE_USER_ID;
        $movie->save();

        $movie = Movie::find($movie->id);
        return response()->json([
            'status' => 200,
            'movie' => $movie,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, $id)
    {
        $movie = Movie::find($id);
        if (is_null($movie)) {
            return response()->json([
                'status' => 400,
                'message' => '対象動画が存在しません。',
            ]); 
        }
        $movie->youtube_id = $request->youtube_id;
        $movie->title = $request->title;
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0;

        $user = User::find(self::API_MOVIE_STORE_USER_ID);
        if (is_null($user)) {
            return response()->json([
                'status' => 400,
                'message' => '動画を保存できるユーザが存在しません。',
            ]); 
        }
        $movie->user_id = self::API_MOVIE_STORE_USER_ID;
        $movie->save();

        $movie = Movie::find($movie->id);
        return response()->json([
            'status' => 200,
            'movie' => $movie,
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if (is_null($movie)) {
            return response()->json([
                'status' => 400,
                'message' => '対象動画が存在しません。',
            ]); 
        }

        $user = User::find(self::API_MOVIE_STORE_USER_ID);
        if (is_null($user)) {
            return response()->json([
                'status' => 400,
                'message' => '動画を保存できるユーザが存在しません。',
            ]); 
        }

        if ($movie->user_id !== self::API_MOVIE_STORE_USER_ID) {
            return response()->json([
                'status' => 400,
                'message' => 'ご指定の動画は削除できません。',
            ]); 
        }

        $movie->delete();
        return response()->json([
            'status' => 200,
            'message' => '動画を削除しました。',
        ]); 
    }
}
