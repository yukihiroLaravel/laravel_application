<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    public function favorites()
    {
        // 多対多を定義 いいね！した一覧を取得
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }
    public function favorite($movieId)
    {
        // 動画に対して、いいね！を実行する関数
        // すでにいいね！されていればfalse
        // されていなければ、いいね！を実行してtrueを返す
        $exist = $this->isFavorite($movieId);
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($movieId);
            return true;
        }
    }
    public function unfavorite($movieId)
    {
        // いいね！をはずす関数
        $exist = $this->isFavorite($movieId);
        if ($exist) {
            $this->favorites()->detach($movieId);
            return true;
        } else {
            return false;
        }
    }
    public function isFavorite($movieId)
    {
        // ユーザーがいいね！しているかどうかを判定
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }
}
