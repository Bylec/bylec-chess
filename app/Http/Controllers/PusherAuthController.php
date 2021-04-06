<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherAuthController extends Controller
{
    public function auth(Request $request)
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            array('cluster' => env('PUSHER_APP_CLUSTER'))
        );

        \Log::debug(__METHOD__);
        \Log::debug($request->get('channel_name'));

        return $pusher->presence_auth(
            $request->get('channel_name'),
            $request->get('socket_id'),
            $this->generateRandomUserId(),
            [
                'user_name' => $this->generateRandomString()
            ]
        );
    }

    private function generateRandomUserId()
    {
        return random_int(1, 100);
    }

    private function generateRandomString($length = 12)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "0123456789";

        mt_srand();

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[mt_rand(0, strlen($codeAlphabet) - 1)];
        }

        return $token;
    }
}
