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

    public function movies(){
        return $this->hasMany(Movie::class);
    }

    // user_idを元にお気に入りされている動画を探して表示する
    public function favorites(){
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }

    // お気に入りを登録する関数
    public function favorite($movieId){
        $exist = $this->isFavorite($movieId);
        if($exist){
            return false;
        }else{
            $this->favorites()->attach($movieId);
            return true;
        }
    }

    // お気に入りを解除する関数
    public function unfavorite($movieId){
        $exist = $this->isFavorite($movieId);
        if($exist){
            $this->favorites()->detach($movieId);
            return true;
        }else{
            return false;
        }
    }

    // ユーザーが特定の動画をお気に入り登録しているかどうかを確認するための関数
    public function isFavorite($movieId){
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }
}
