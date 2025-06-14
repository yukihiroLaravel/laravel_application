<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;
    public function user()
    {
        // $thisはMovieのインスタンスを指し、belongsToは１対多のリレーションを定義するメソッド
        // User::classはUserモデルを指し、MovieモデルがUserモデルに属することを示す（Userは複数のMovieを持つことができる）
        // これをすることで、動画情報からユーザー情報を取得できるようになる
        // また、$user->movies()->get();と書くだけで、ユーザ情報から動画情報を取得できるようになる
        return $this->belongsTo(User::class);
    }
}