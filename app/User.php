<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\softDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function favorites()//ユーザがいいね！した動画一覧を簡単に取得する
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }

    public function favorite($movieId)//動画をいいね！付ける
    {
        $exist = $this->isFavorite($movieId);
        if($exist){
            return false;//二重いいね！を防ぐ
        }
        else {
            $this->favorites()->attach($movieId);
            return true;
        }
    }

    public function unfavorite($movieId)//いいね！を外す
    {
        $exist = $this->isFavorite($movieId);
        if($exist){
            $this->favorites()->detach($movieId);
            return true;
        }
        else {
            return false;
        }
    }

    public function isFavorite($movieId) //動画をすでにいいね！しているか判定
    {
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }
}

