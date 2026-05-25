<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //追加

class Movie extends Model
{
    //
    use SoftDeletes; // 論理削除

    public function user()
    {
        return $this->belongsTo(User::class); // 動画情報のインスタンスからユーザー情報を取得する関数
        
    }

}
