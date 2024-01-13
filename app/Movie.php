<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
