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

    //動画投稿時の処理内容
    public function movies() //moviesメソッド
    {
        return $this->hasMany(Movie::class); //Movieクラスを指定して1対多の関係を宣言(hasMany １側)
    }

    //お気に入り処理
    public function favorites() //favoriteメソッド
    {
        return $this->belongsToMany(Movie::class,'favorites','user_id','movie_id')->withTimestamps();
        //Movieクラスを指定して多対多のリレーションを定義
        //中間テーブルにfavoritesテーブルを使用
        //user_idとmovie_idをリレーション
        //中間テーブルに自動でタイムスタンプ
    }

    public function isFavorite($movieId) //isFavoriteメソッド(引数、$movieId　選択されたmovieのid)
    {
        return $this->Favorites()->where('movie_id', $movieId)->exists();
        //リレーションメソッドのfavoritesを呼び出し、favoritesテーブルを操作
        //対象ユーザーのfavoriteテーブルから指定されたmovie_idを検索
        //該当するmovie_idが存在するか確認
    }

    public function favorite($movieId) //favoriteメソッド(引数、指定されたmovieのid)
    {
        $exist = $this->isFavorite($movieId); //対象ユーザーが指定されたmovie_idを登録しているか確認
        if($exist){ //登録していたら
            return false; //処理をせず返却
        }else{ //登録していなければ
            $this->favorites()->attach($movieId); //favoritesテーブルにmovie_idを追加
            return true; //処理成功を返却
        }
    }

    public function unfavorite($movieId) //unfavoriteメソッド(引数、渡されたmovieのid)
    {
        $exist = $this->isFavorite($movieId);//対象ユーザが指定されたmovie_idを登録しているか確認
        if($exist){ //登録していれば
            $this->favorites()->detach($movieId); //favoritesテーブルのmovie_idを削除
            return true; //処理成功を返却
        }else{ //登録していなければ
            return false; //処理をせず返却
        }
    }
}
