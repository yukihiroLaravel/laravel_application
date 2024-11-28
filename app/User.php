<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    /**
     * ユーザ情報のインスタンスから動画情報を取得する
     */
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    /**
     * ユーザがいいね！した動画一覧を取得
     * 多対多
     * belongsToMany(相手のモデル, '中間テーブル名', '自モデルの外部キー名', '相手モデルの外部キー名')
     */
    public function favorites()
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }

    /**
     * 動画に対して、いいね！を実行する
     * すでにいいね！していたらfalse、いいね！していなければいいね！を実行true
     */
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

    /**
     * 動画に対して、いいね！を解除する
     * すでにいいね！していればいいね！解除後にtrue、いいね！していなけばfalse
     */
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

    /**
     * すでにいいね！しているかを判定
     * いいね！していたらtrue、いいね！していない場合false
     */
    public function isFavorite($movieId)
    {
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }
}
