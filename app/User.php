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

    public function movies() //ムービークラスと1対多でリレーションを設定（１）->動画投稿処理
    {
        return $this->hasMany(Movie::class);
    }


    public function favorites() //お気に入り処理 多対多の関係の中間テーブルの設定->お気に入り処理
    {
        return $this->belongsToMany(Movie::class,'favorites','user_id','movie_id')->withTimestamps();
    }

    public function isFavorite($movieId) //お気に入り済か否かの判定
    {
        return $this->Favorites()->where('movie_id', $movieId)->exists();
    }

    public function favorite($movieId) //お気に入り処理
    {
        $exist = $this->isFavorite($movieId);
        if($exist){
            return false;
        }else{
            $this->favorites()->attach($movieId);
            return true;
        }
    }

    public function unfavorite($movieId) //お気に入り外す処理
    {
        $exist = $this->isFavorite($movieId);
        if($exist){
            $this->favorites()->detach($movieId);
            return true;
        }else{
            return false;
        }
    }
}
