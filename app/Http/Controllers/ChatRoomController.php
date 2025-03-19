<?php

namespace App\Http\Controllers;

use App\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index()
    {
        $ChatRooms = ChatRoom::all();
        return view('chat_rooms.index', ['ChatRooms' => $ChatRooms]);
    }
}
