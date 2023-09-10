<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    // 多対多設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // favoritesテーブル
    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'movie_id', 'user_id')->withTimestamps();
    }

    // commentsテーブル
    public function comments()
    {

        return $this->hasMany(Comment::class);

    }

}