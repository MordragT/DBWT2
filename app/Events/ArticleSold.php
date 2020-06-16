<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ArticleSold implements ShouldBroadcast
{
    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    //public $update;
    public $user_id;
    public $article_id;
    public function __construct($user_id, $article_id)
    {
        $this->user_id = $user_id;
        $this->article_id = $article_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\PrivateChannel
     */
    public function broadcastOn()
    {
        return new Channel('ab_user.' . $this->user_id);
    }
}
