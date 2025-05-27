<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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
        // ユーザと動画の多対多リレーションを定義
        // favoritesテーブルを中間テーブルとして使用
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }
    
    public function favorite($movieId)
    {
        // ユーザが特定の動画をお気に入り登録するメソッド
        // まず、ユーザがその動画をお気に入り登録しているかどうかを確認
        $exist = $this->isFavorite($movieId);
        // 存在しない場合は、お気に入りに追加する
        // attach() メソッドは、指定された動画IDをお気に入りに追加するために使用される
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($movieId);
            return true;
        }
    }
    
    public function unfavorite($movieId)
    {
        // ユーザが特定の動画をお気に入りから外すメソッド
        // まず、ユーザがその動画をお気に入り登録しているかどうかを確認
        $exist = $this->isFavorite($movieId);
        // 存在する場合は、お気に入りから外す
        // detach() メソッドは、指定された動画IDをお気に入りから削除するために使用される
        if ($exist) {
            $this->favorites()->detach($movieId);
            return true;
        } else {
            return false;
        }
    }
    
    // ユーザが特定の動画をお気に入り登録しているかどうかを確認するメソッド
    public function isFavorite($movieId)
    {
        // ユーザのお気に入り動画の中に、指定された動画IDが存在するかを確認
        // exists() メソッドは、クエリが結果を返すかどうかを確認するために使用される
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }
}