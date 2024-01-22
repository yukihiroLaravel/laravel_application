<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Movie extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
