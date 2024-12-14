<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Movie extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'movie_id', 'user_id')->withTimestamps();
    }
}
