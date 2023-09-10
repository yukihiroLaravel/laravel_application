<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
