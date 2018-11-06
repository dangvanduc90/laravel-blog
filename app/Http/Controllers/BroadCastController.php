<?php

namespace App\Http\Controllers;

use Pusher\Pusher;

require_once(__DIR__.'/../../../vendor/autoload.php');

class BroadCastController extends Controller
{
    public function getPusher()
    {
        // gọi ra trang view demo-pusher.blade.php
        return view("broadcast.demo-pusher");
    }

    public function fireEvent()
    {
//        // Truyền message lên server Pusher
//        event(new DemoPusherEvent("Hi, I'm Trung Quân. Thanks for reading my article!"));
//        return "Message has been sent.";
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        );

        try {
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $data['message'] = 'hello world';
            $pusher->trigger('channel-demo-real-time', 'my-event', $data);
            return "Message has been sent.";
        } catch (\Exception $e) {
            return "Message has been error. " . $e->getMessage();
        }
    }
}
