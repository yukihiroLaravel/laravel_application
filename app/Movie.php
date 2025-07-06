<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;
    public function user()
    {
        // $thisはMovieのインスタンスを指し、belongsToは１対多のリレーションを定義するメソッド
        // User::classはUserモデルを指し、MovieモデルがUserモデルに属することを示す（Userは複数のMovieを持つことができる）
        // これをすることで、動画情報からユーザー情報を取得できるようになる
        // また、$user->movies()->get();と書くだけで、ユーザ情報から動画情報を取得できるようになる
        return $this->belongsTo(User::class);
    }

    // ユーザーがいいね！した動画を取得するためのリレーション
    // belongsToManyは多対多のリレーションを定義するメソッドで関係性を構築
    // belongsToMany(相手のモデル, ‘中間テーブル名’, ‘自モデルの外部キー名’, ‘相手モデルの外部キー名’)
    // これをすることで、動画情報からユーザ情報を取得できるようになる
    // $movie->favoriteUsers()->get();　で動画をいいね！したユーザ一覧を取得できるようになる
   
    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'movie_id', 'user_id')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}