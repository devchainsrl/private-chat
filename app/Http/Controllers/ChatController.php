<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function rooms(Request $request)
    {
        return ChatRoom::all();
    }

    public function messages(Request $request)
    {
        $id = $request->route('roomId');
        /** @var ChatRoom $room */
        $room = ChatRoom::findOrFail($id);
        return $room->messages()->with('user')->orderBy('created_at', 'desc')->get();
    }

    public function newMessage(Request $request)
    {
        $id = $request->route('roomId');
        $message = $request->input('message', '(empty message)');

        $newMessage = ChatRoom::findOrFail($id)->messages()->make([]);

        $newMessage->user_id = Auth::user()->id;
        $newMessage->message = $message ?: '';

        $newMessage->save();

        return $newMessage;
    }
}
