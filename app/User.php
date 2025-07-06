<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; // 追記

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes; // 追記

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
        // $thisはUserのインスタンスを指し、hasManyは１対多のリレーションを定義するメソッド
        // Movie::classはMovieモデルを指し、Userモデルが複数のMovieを持つことを示す（Userは複数のMovieを持つことができる）
        // これをすることで、ユーザー情報から動画情報を取得できるようになる
        // また、$movie->user()->get();と書くだけで、動画情報からユーザ情報を取得できるようになる
        return $this->hasMany(Movie::class);
    }

    // ユーザーがいいね！した動画を取得するためのリレーション
    public function favorites()
    {
        // belongsToManyは多対多のリレーションを定義するメソッドで関係性を構築
        // belongsToMany(相手のモデル, ‘中間テーブル名’, ‘自モデルの外部キー名’, ‘相手モデルの外部キー名’)
        // UserとMovieの間に中間テーブル（favorites）が存在し、ユーザーが複数の動画にいいね！できることを示す
        // 関係性ができているので、$user->favorites()->get();isFavorite($movieId)で、ユーザがいいね！した動画一覧を簡単に取得できる
        // $user->isFavorite(1);favorite($movieId) で動画を既にいいね！しているか？を判定できる。
        // $user->favorite(2);unfavorite($movieId)で動画に対して、いいね！を実行してくれる。
        // $user->unfavorite(2);で動画に対して、いいね！を解除してくれる。
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }

    // ユーザーが特定の動画に対していいね！をするメソッド
    // favoritesテーブルにmovie_idとuser_idを追加
    // existsメソッドを使用して、特定の動画に対するいいね！が既に存在するかどうかを確認
    // 動画IDが一致するレコードがfavoritesテーブルに存在しない場合は、attachメソッドを使用して、動画IDをfavoritesテーブルに追加
    // isFavoriteメソッドを使用して、動画IDが一致するレコードがfavoritesテーブルに存在するかどうか（いいねされているか）を確認
    // 存在する場合（いいねされている場合）は、falseを返す
    // 存在しない場合(いいねされていない場合）は、動画IDをfavoritesテーブルに追加（動画にいいね）し、trueを返す
    
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

    // ユーザーが特定の動画に対していいね！を解除するメソッド
    // favoritesテーブルからmovie_idが一致するレコードを削除
    // detachメソッドを使用して、特定の動画に対するいいね！を解除
    // isFavoriteメソッドを使用して、動画IDが一致するレコードがfavoritesテーブルに存在するかどうか（いいねされているか）を確認
    // 存在する場合（いいねされている場合）は、動画IDをfavoritesテーブルから削除し、trueを返す
    // 存在しない場合（いいねされていない場合）は、falseを返す
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

    // ユーザーが特定の動画をいいね！しているかどうかを確認するメソッド
    // whereメソッドを使用して、favoritesテーブルからmovie_idが一致するレコードを検索
    // existsメソッドで存在するかどうかを確認
    // 動画IDが一致するレコードがfavoritesテーブルに存在する場合はtrueを返し、存在しない場合はfalseを返す
    public function isFavorite($movieId)
    {
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
