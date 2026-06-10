<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content',
        'movie_id',
        'user_id',
        'parent_id',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent() // このコメントが返信しているコメント
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies() // このコメントに対する返信一覧
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('id', 'asc');
    }

    public function hasDescendant($commentId)
    {
        foreach ($this->replies as $reply) {
            if ((int) $reply->id === (int) $commentId) {
                return true;
            }

            if ($reply->hasDescendant($commentId)) {
                return true;
            }
        }

        return false;
    }
}
