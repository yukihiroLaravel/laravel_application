<?php

namespace App\Http\Controllers;

use App\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index()
    {
        $chatRooms = ChatRoom::all();
        return view('chat_rooms.index', ['chatRooms' => $chatRooms]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
       $chatRoom = ChatRoom::create($request->all());
        return redirect()->route('chat_rooms.index', ['chatRoom' => $chatRoom]);
    }

    public function show(ChatRoom $chatRoom)
    {
        return view('chat_rooms.show', ['chatRoom' => $chatRoom]);
    }
}
