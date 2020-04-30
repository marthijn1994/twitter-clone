<?php

namespace App\Events\Tweets;

use App\Tweet;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TweetLikesWereUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Tweet
     */
    protected $tweet;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Tweet $tweet
     */
    public function __construct(User $user, Tweet $tweet)
    {
        $this->tweet = $tweet;
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->tweet->id,
            'user_id' => $this->user->id,
            'count' => $this->tweet->likes->count(),
        ];
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'TweetLikesWereUpdated';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('tweets');
    }
}
