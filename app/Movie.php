<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 論理削除

class Movie extends Model
{
    //論理削除のメソッド
    use SoftDeletes;

    public function user()
    {
        // MovieクラスがUserクラスに所有されている（所属している）
        return $this->belongsTo(User::class);
    }
}
