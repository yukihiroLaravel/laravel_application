<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 追記

class Movie extends Model
{
    use SoftDeletes; //追記
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'movie_id', 'user_id')->withTimestamps();
    }

}
