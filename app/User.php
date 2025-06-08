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
    // ユーザが登録できる属性を定義
    // ここでは、name, email, passwordの3つの属性を定義
     protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // ユーザのパスワードとremember_tokenを配列に変換する際に非表示にする属性を定義
    // ここでは、passwordとremember_tokenの2つの属性を定義
     protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // ユーザの属性を特定のデータ型に変換するためのキャストを定義
    // ここでは、email_verified_atをdatetime型に変換するためのキャストを定義
     protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // ユーザは複数の動画を持つことができる
    // つまり、UserモデルはMovieモデルと1対多のリレーションを持つ
    public function movies()
    {
        // ユーザと動画の1対多リレーションを定義
        // hasMany() メソッドを使用して、Userモデルが複数のMovieモデルを持つことを示す
        return $this->hasMany(Movie::class);
    }
    
    // ユーザは複数のお気に入り動画を持つことができる
    // つまり、UserモデルはMovieモデルと多対多のリレーションを持つ
    //　いいねした動画一覧を簡単に取得するためのリレーションを定義
    public function favorites()
    {
        // ユーザと動画の多対多リレーションを定義
        // favoritesテーブルを中間テーブルとして使用
        // belongsToMany() メソッドを使用して、Userモデルが複数のMovieモデルを持つことを示す
        // belongsToMany(相手のモデル, ‘中間テーブル名’, ‘自モデルの外部キー名’, ‘相手モデルの外部キー名’)
        // belongsToMany関数を記述した、favorites()関数を下記のように使うと、
        // ユーザがいいね！した動画一覧を簡単に取得することができます。
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }
    
    public function favorite($movieId)
    {
        // ユーザが特定の動画をいいねするメソッド
        // まず、ユーザがその動画をいいねしているかどうかを確認
        $exist = $this->isFavorite($movieId);
        // 存在しない場合は、お気に入りに追加する
        // attach() メソッドは、指定された動画IDをお気に入りに追加するために使用される
        // もし動画がすでにお気に入りに登録されている場合は、何もしない
        // つまり、動画がすでにお気に入りに登録されている場合は、何もせずにfalseを返す
        if ($exist) {
            return false;
        } else {
            // ユーザが動画をお気に入りに追加する
            $this->favorites()->attach($movieId);
            return true;
        }
    }
    
    public function unfavorite($movieId)
    {
        // ユーザが特定の動画のいいねを外すメソッド
        // まず、ユーザがその動画をお気に入り登録しているかどうかを確認
        $exist = $this->isFavorite($movieId);
        // いいねが存在する場合は、お気に入りから外す
        // detach() メソッドは、指定された動画IDをお気に入りから削除するために使用される
        if ($exist) {
            $this->favorites()->detach($movieId);
            return true;
        } else {
            return false;
        }
    }
    
    // ユーザが特定の動画をいいねしているかどうかを確認するメソッド
    public function isFavorite($movieId)
    {
        // ユーザのいいねした動画の中に、指定された動画IDが存在するかを確認
        // exists() メソッドは、クエリが結果を返すかどうかを確認するために使用される
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }
}