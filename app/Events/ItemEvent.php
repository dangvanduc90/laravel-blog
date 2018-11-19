<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class ItemEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $item
     */
    public function itemCreated(User $item)
    {
        Log::info("User Created Event Fire: ".$item);
    }

    /**
     * @param User $item
     */
    public function itemUpdated(User $item)
    {
        Log::info("User Updated Event Fire: ".$item);
    }

    /**
     * @param User $item
     */
    public function itemDeleted(User $item)
    {
        Log::info("User Deleted Event Fire: ".$item);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
