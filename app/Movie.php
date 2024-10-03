<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Movie extends Model
{
    use SoftDeletes;
    public function user()//Userテーブルと1対1のリレーション。
    {
        return $this->belongsTo(User::class);//ユーザークラスに所有されている。
    }

    public function favoriteUsers()//UserテーブルとMovieテーブルの中間テーブルを定義。つまりはいいねのテーブル。
    {
        return $this->belongsToMany(User::class,'favorites','movie_id','user_id')->withTimestamps();
    }
}
