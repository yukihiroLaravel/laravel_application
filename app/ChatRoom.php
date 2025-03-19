<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Message;

class ChatRoom extends Model
{
    protected $fillable = [
        'name',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
