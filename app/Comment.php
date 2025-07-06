<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'movie_id', 'comment',
    ];

    public function user()
    {
        // $thisはCommentのインスタンスを指し、belongsToは１対多のリレーションを定義するメソッド
        // User::classはUserモデルを指し、CommentモデルがUserモデルに属することを示す（Userは複数のCommentを持つことができる）
        // これをすることで、コメント情報からユーザー情報を取得できるようになる
        return $this->belongsTo(User::class);
    }
    public function movie()
    {
        // $thisはCommentのインスタンスを指し、belongsToは１対多のリレーションを定義するメソッド
        // Movie::classはMovieモデルを指し、CommentモデルがMovieモデルに属することを示す（Movieは複数のCommentを持つことができる）
        // これをすることで、コメント情報から動画情報を取得できるようになる
        return $this->belongsTo(Movie::class);
    }
}
