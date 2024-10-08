<?php

namespace App\Events;

use App\Models\Fandom;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FandomUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Fandom $fandom,
    ){}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('FandomProfile.' . $this->fandom->id),
            new Channel('FandomProfile.' . $this->fandom->id),
            new Channel('FandomList.' . $this->fandom->id),
            new Channel('FandomsPostCard.' . $this->fandom->id),
            new Channel('UsersFandomCard.' . $this->fandom->id),
        ];
    }
}
