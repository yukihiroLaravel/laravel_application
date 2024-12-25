<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;
    //動画登録
    public function user() //userメソッド
        {
            return $this->belongsTo(User::class);//userクラスとの1対多のリレーションシップを設定（多側）
        }

    //お気に入り処理
    public function favoriteUsers() //favoriteUsersメソッド
    {
        return $this->belongsToMany(User::class,'favorites','movie_id','user_id')->withTimestamps();
        //userクラスと多対多のリレーションを設定
        //中間テーブルにfavoritesを設定
        //movie_id、usr_idをリレーション
        //作成、更新のカラムを追加
    }
}
