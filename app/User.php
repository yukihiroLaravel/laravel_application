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
    public function favorites()
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }//belongsToMany:多対多の関係でそれぞれのモデルを結びつける時に使う
     //第1引数（Movie::class）相手のモデル
     //第2引数（favorites）結び付ける中間テーブル
     //第3引数（user_id）自分のモデルの外部キーの名前
     //第4引数（movie_id）ムービーモデルの外部キーの名前


    public function favorite($movieId)//favorite（動画）に対して、いいね！を実行してくれる関数
    {
        $exist = $this->isFavorite($movieId);
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($movieId);
            return true;
        }
    }

    //Laravelに備え付けの関数である、attach()/detach()を用いて、
    //中間テーブルにレコード作成/レコード削除を簡単に行うことができます。

    public function unfavorite($movieId)//unfavorite（動画）に対して、いいね！を解除してくれる関数
    {
        $exist = $this->isFavorite($movieId);
        if ($exist) {
            $this->favorites()->detach($movieId);
            return true;
        } else {
            return false;
        }
    }

    public function isFavorite($movieId)
    //isFavorite：既に(動画)をユーザーがいいねしていれば真を返す関数
    {
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }//where:検索する、第1引数（movie_id）カラムの中に第2引数（$movieId）があるかどうか
}


