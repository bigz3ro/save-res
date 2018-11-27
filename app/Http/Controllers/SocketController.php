<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LRedis;
use Auth;
use App\Events\RedisEvents;

class SocketController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function index()
    {
        return view('socket.index');
    }

    public function getChat(Request $request)
    {
        return view('socket.message-get');
    }

    public function postSend(Request $request)
    {
        $redis = LRedis::connection();
        $redis->publish('message', $request->input('message'));

        return response()->json(['status' => 'success', 'message' => 'oke']);
    }
}
