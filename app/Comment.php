<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'comment',
        'movie_id',
        'user_id',
    ];

    public function movie()
    {
        return $this->belongsTo(movie::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

}