<?php


namespace App\Notifications\Tweets;

use App\Http\Resources\TweetResource;
use App\Http\Resources\UserResource;
use App\Notifications\DatabaseNotificationChannel;
use App\Tweet;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TweetRepliedTo extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $tweet;

    /**
     * Create a new notification instance.
     *
     * @param Tweet $tweet
     * @param User $user
     */
    public function __construct(User $user, Tweet $tweet)
    {
        $this->user = $user;
        $this->tweet = $tweet;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DatabaseNotificationChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user' => new UserResource($this->user),
            'tweet' => new TweetResource($this->tweet)
        ];
    }
}
