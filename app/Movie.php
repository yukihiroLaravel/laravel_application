<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Movie extends Model
// 追加: Movieモデルは動画情報を管理するためのモデル
{
    use SoftDeletes;
    // 追加: SoftDeletesトレイトを使用して、論理削除を有効にする
    public function user()
    // 追加: MovieモデルはUserモデルと1対多のリレーションを持つ
    // つまり、1人のユーザが複数の動画を持つことができる
    {
        // 追加: MovieモデルはUserモデルに属する
        // belongsToメソッドを使用して、Userモデルとのリレーションを定義
        return $this->belongsTo(User::class);
    }
    public function favoriteUsers()
    // 追加: MovieモデルはUserモデルと多対多のリレーションを持つ
    // つまり、1つの動画が複数のユーザに「いいね」されることができる
    {
        // 追加: MovieモデルはUserモデルとの多対多のリレーションを定義
        // belongsToManyメソッドを使用して、Userモデルとのリレーションを定義
        return $this->belongsToMany(User::class, 'favorites', 'movie_id', 'user_id')->withTimestamps();
    }
}