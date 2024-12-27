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
    //このUserクラス(モデル)は、Movieクラス(モデル)を複数所有する、というリレーションシップを定義
    //ユーザー情報から、動画を取得することができる
    ////$user->movies()->get();とインスタンス化し、movies関数を呼び出せるようになる

    //「hasMany」は、Eloquent ORM で使われるメソッドで、データベースのリレーションシップを定義するため関数
    //具体的には、「あるモデルが複数の関連するモデルを持っている」という関係を定義する


    //ユーザー情報から「いいね」した映画の情報を取得するためのメソッド
    public function favorites() 
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }
    

    //ログインユーザーが動画をいいね！、お気に入りに追加する処理
    public function favorite($movieId)
    {
        $exist = $this->isFavorite($movieId);
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($movieId);
            return true;
        }
    }

    //ログインユーザーが動画をいいね！お気に入りから外す処理
    public function unfavorite($movieId)
    {
        $exist = $this->isFavorite($movieId);
        if ($exist) {
            $this->favorites()->detach($movieId);
            return true;
        } else {
            return false;
        }
    }

    //動画がすでにいいね！お気に入りにあるが確認する処理
    public function isFavorite($movieId) 
    {
        return $this->favorites()->where('movie_id',$movieId)->exists();
    }

}
