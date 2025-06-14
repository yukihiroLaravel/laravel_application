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
}
