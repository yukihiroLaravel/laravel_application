<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use softDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
