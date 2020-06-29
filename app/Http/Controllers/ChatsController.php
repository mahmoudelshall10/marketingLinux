<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Message::with('user')->get());
        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        dd($user);
        $messages = $user->messages();

        // broadcast(new MessageSent($user, $messages))->toOthers();
        return view('chat' , compact('messages' , 'user'));
        // return ['status' => 'Message Sent!' , 'messages' => $messages ];
    }
}
