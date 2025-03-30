<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required|exists:chat_rooms,id',
            'nickname' => 'required|string|max:8',
            'message' => 'required|string',
        ]);
        $message = Message::create($request->all());
        return response()->json($message);

        // 元々下記のように書いてあったが、そこから変更 $message->chatRoomの書き方がよくわからなくて、チャットGTPに質問
        // return redirect()->route('chat_rooms.show', ['ChatRoom' => $message->chatRoom]);
    }

    public function index($ChatRoom)
    {
        return response()->json(Message::where('chat_room_id', $ChatRoom)->get());
    }
}
