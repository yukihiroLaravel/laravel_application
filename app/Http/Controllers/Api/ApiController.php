<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movie;
use App\User;

class ApiController extends Controller
{
    const API_MOVIE_STORE_USER_ID = 2;
    
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return response()->json([
            'status' => 200,
            'movie' => $movie,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
                'message' => '動画を更新できるユーザが存在しません。',
            ]);
        }
        $movie->user_id = self::API_MOVIE_STORE_USER_ID;
        $movie->save();
        // 動画の更新が成功した場合のレスポンス
        // 動画の更新が成功した場合、200ステータスコードと更新された動画情報を返す
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
        // 動画を削除する
        $movie = Movie::find($id);
        // 動画が存在しない場合、400ステータスコードとメッセージを返す
        // findメソッドは、指定したIDの動画が存在しない場合にnullを返す
        if (is_null($movie)) {
            return response()->json([
                'status' => 400,
                'message' => '対象動画が存在しません。',
            ]);
        }
        // 動画の所有者がAPI_MOVIE_STORE_USER_IDであることを確認
        // API_MOVIE_STORE_USER_IDは、動画を保存・更新・削除できるユーザのID
        // ここでは、API_MOVIE_STORE_USER_IDは2と定義されている
        // つまり、動画を保存・更新・削除できるユーザは、IDが2のユーザ
        // そのユーザが存在しない場合は、400ステータスコードとメッセージを返す
        $user = User::find(self::API_MOVIE_STORE_USER_ID);
        if (is_null($user)) {
            return response()->json([
                'status' => 400,
                'message' => '動画を削除できるユーザが存在しません。',
            ]);
        }
        if ($movie->user_id !== self::API_MOVIE_STORE_USER_ID) {
            // 動画の所有者がAPI_MOVIE_STORE_USER_IDと一致しない場合、削除できない
            // つまり、API_MOVIE_STORE_USER_ID以外のユーザが動画を削除しようとした場合
            // その場合は、400ステータスコードとメッセージを返す
            return response()->json([
                'status' => 400,
                'message' => 'ご指定の動画は削除できません。',
            ]);
        }
        $movie->delete();
        // 動画の削除が成功した場合のレスポンス
        // 動画の削除が成功した場合、200ステータスコードとメッセージを返す
        return response()->json([
            'status' => 200,
            'message' => '動画を削除しました。',
        ]);
    }
}
