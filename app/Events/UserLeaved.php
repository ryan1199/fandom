<?php

namespace App\Events;

use App\Models\Fandom;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLeaved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Fandom $fandom,
        public User $user,
    ){}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('FandomMemberList.' . $this->fandom->id),
            new PrivateChannel('FandomsRequestForm.' . $this->fandom->id),
            new PrivateChannel('FandomDetails.' . $this->fandom->id),
            new PrivateChannel('UsersFandomList.' . $this->user->id),
            new PrivateChannel('LeftSideNavigationBar.' . $this->user->id),
        ];
    }
}
