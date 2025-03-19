<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\ChatRoom;

class Message extends Model
{
    public $fillable = [
        'chat_room_id',
        'nickname',
        'message'
    ];

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }
}
