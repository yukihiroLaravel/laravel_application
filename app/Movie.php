<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);//$thisはclass movieのこと。$thisはUser::classに所属しているという意味
    }

}
