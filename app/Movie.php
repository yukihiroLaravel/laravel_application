<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;
    public function user() // ユーザークラスとの1対多の関係を宣言（多）->動画投稿処理
        {
            return $this->belongsTo(User::class);
        }

    public function favoriteUsers() //ユーザークラスとの多対多の関係の中間テーブルの設定->お気に入り処理
    {
        return $this->belongsToMany(User::class,'favorites','movie_id','user_id')->withTimestamps();
    }
}
