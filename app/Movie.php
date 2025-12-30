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
        // 「this」はこのクラス（Movie）のこと。このreturanの記述は、
        // 「このMovieクラスは、Userクラスに所属してますよ」という意味。
        // （このメソッドがあることによって、動画情報のインスタンスから、ユーザー情報を取得できる）
        // （ユーザーから動画情報も取得できる）
        //  下記のコードを書くだけで、動画情報からユーザ情報を取得できます。
        //  $movie->user()->get();
        //  併せて、ユーザモデルの時と同様に、論理削除の設定もしておきます。(6行目)

    }

}
