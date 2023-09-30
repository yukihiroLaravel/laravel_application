<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\softDeletes;

class Movie extends Model
{
    use softDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
