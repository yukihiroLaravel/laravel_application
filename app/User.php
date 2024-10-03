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
    public function movies()//Movieテーブルとの1対多のリレーションを定義。UserクラスはMovieクラスを所有する。
    {
        return $this->hasMany(Movie::class);
    }

    public function favorites()//Movieテーブルとの多対多のリレーションを定義。favoritesテーブルが中間テーブルとなりfavoritesテーブルにuser_id(User)とmovie_id(Movie)カラムを定義する。
    {
        return $this->belongsToMany(Movie::class, 'favorites','user_id','movie_id')->withTimestamps();//この中間テーブルのカラムに値(いいね)が追加されたり削除される。つまりは、ユーザーがいいねした動画一覧を簡単に取得できる。
    }

    public function favorite($movieID)//いいねをするメソッド。
    {
        $exist = $this->isFavorite($movieID);//いいねしている場合false。していない場合いいねする。
        if ($exist) {
            return false;
        }
        else{
            $this->favorites()->attach($movieID);//attachはへルパメソッド(元々備わっているメソッド)
            return true;
        }
    }

    public function unfavorite($movieID)//いいねを外すメソッド。
    {
        $exist = $this->isFavorite($movieID);//いいねしている場合いいねを削除。していない場合false。
        if ($exist){
            $this->favorites()->detach($movieID);
            return true;
        }
        else{
            return false;
        }
    }

    public function isFavorite($movieID)//いいねしているか、していないかがわかるメソッド。いいねしていればtrue、していない場合false。
    {
        return $this->favorites()->where('movie_id',$movieID)->exists();//favoritesテーブルのmovie_idカラムにmovieIDがあるかどうかチェックする。
    }
}
