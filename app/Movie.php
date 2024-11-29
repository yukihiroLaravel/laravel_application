<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //このMovieクラス(モデル)はUserクラス(モデル)に所属する、という意味
    //動画情報から、ユーザー情報を取得することができる
    //このメソッドがあることにより、
    //$movie->user()->get();とインスタンス化し、user関数を呼び出せるようになる
    //「belongsTo」= 所属する 
    //Eloquent ORM で使われるメソッドで、データベースのリレーションシップを定義するためのもの
    //「belongsTo」は、「このモデルが他のモデルに属している」という関係を表します。具体的には、「多対1（Many-to-One）」の関係を定義するために使われる
}
