<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    const API_MOVIE_STORE_USER_ID = 9;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //indexメソッド(一覧表示)
    {
        $movies = Movie::orderBy('id', 'desc')->get(); //moviesテーブルのデータ(movie)をidを基準に取得
        return response()->json([ //jsonデータをクライアントに返す
            'status' => 200, //成功スタッツ
            'movies' => $movies, //取得した$movieデータをmovieキーにセットして返却
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //storeメソッド(データ登録)
    {
        $movie = new Movie; //movieモデルの新しいインスタンスを作成（moviesテーブルに追加用）
        $movie->youtube_id = $request->youtube_id; //リクエストで受けたyoutube_idをmovieテーブルのカラムにセット
        $movie->title = $request->title; //リクエストで受けたtitleをmovieテーブルのカラムにセット
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0; //リクエストで受けたfavorite_flagをbooleanから整数(0or1)に戦艦してmovieテーブルのカラムにセット

        $user = User::find(self::API_MOVIE_STORE_USER_ID); //Userモデルから指定したIDのユーザーを取得
        if(is_null($user)){ //指定したユーザーが不在の場合
            return response()->json([ //クライアントにjsonで返却
                'status' => 400, //失敗スタッツ
                'message' => 'ユーザーが不在です', //メッセージ
            ]);
            }
            $movie->user_id = self::API_MOVIE_STORE_USER_ID; //movieデータのuseridカラムに指定したユーザーidをセット
            $movie->save(); //データベースに新しいmovieレコードを保存
            return response()->json([ //クライアントに返却
                'status' => 200, //成功スタッツ
                'movie' => $movie, //$movieに格納したデータをmovieキーにして返却
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //更新メソッド
    {
        $movie = Movie::find($id); //$movieにMovieクラスからリクエストを送信したidを格納
        if(is_null($movie)){ //idに対応するデータが存在しない場合
            return response()->json([ //クライアントにjsonデータを返却
                'status' => 400, //失敗スタッツ
                'message' => '対象動画無し', //メッセージ
            ]);
        } //以下、idが存在した場合の処理
        $movie->youtube_id = $request->youtube_id; //リクエストされたyoutube_idをカラムにセット
        $movie->title = $request->title; //リクエストされたtitleをカラムにセット
        $movie->favorite_flag = $request->favorite_flag ? 1 : 0; //リクエストされたfavorite_idをカラムにセット
        $user = User::find(self::API_MOVIE_STORE_USER_ID); //Userモデルから指定されたIDのユーザー情報を取得
        if(is_null($user)){ //対象のユーザーが見つからない場合
            return response()->json([ //クライアントにjsonデータを返却
                'status' => 400, //失敗スタッツ
                'massage' => 'ユーザー不在', //メッセージ
            ]);
        } //以下対象ユーザーが存在した場合の処理
        $movie->user_id = self::API_MOVIE_STORE_USER_ID; //対象のIDをカラムにセット
        $movie->save(); //データベースにここまでセットした内容を保存
        return response()->json([ //クライアントにjsonデータを返却
            'status' => 200, //成功スタッツ
            'movie' => $movie, //メッセージ
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //削除メソッド
    {
        $movie = Movie::find($id); //Movieクラスから対象のidを検索して取得
        if(is_null($id)){ //idが存在しなかったら
            return response()->json([ //クライアントにエラーjsonを返却
                'status' => 200,
                'message' => '対象動画が存在しません',
            ]);
        }
        $user = User::find(self::API_MOVIE_STORE_USER_ID); //Userクラスから対象のIDを検索して取得
        if(is_null($user)){ //idが存在しなかったら
            return response()->json([ //クライアントにエラーjsonを返却
                'status' => 200,
                'message' => 'ユーザーが存在しません',
            ]);
        } //以下、対象のidが存在した際の処理
        if($movie->user_id !== self::API_MOVIE_STORE_USER_ID){ //movieテーブルのuser_idと対象idが違うなら
            return response()->json([ //クライアントにえらーjsonを返却
                'status' => 200,
                'message' => '権限のあるユーザーでありません',
            ]);
        } //以下、対象idとuser_idが同様の際の処理
        $movie->delete(); //対象の動画を削除
        return response()->json([ //クライアントに成功のjsonを返却
            'status' => 400,
            'message' => '削除完了',
        ]);
    }
}
