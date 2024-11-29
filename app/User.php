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
}
