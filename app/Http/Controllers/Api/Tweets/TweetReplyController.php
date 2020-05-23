<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetRepliesWereUpdated;
use App\Http\Controllers\Controller;
use App\Notifications\Tweets\TweetRepliedTo;
use App\Tweet;
use App\TweetMedia;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class TweetReplyController extends Controller
{

    /**
     * TweetReplyController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request, Tweet $tweet)
    {
        $reply = $request->user()->tweets()->create(
            array_merge($request->only('body'), [
                    'type' => TweetType::TWEET,
                    'parent_id' => $tweet->id
                ]
            )
        );

        foreach ($request->media as $id) {
            $reply->media()->save(TweetMedia::find($id));
        }

        if ($request->user()->id !== $tweet->user_id) {
            $tweet->user->notify(new TweetRepliedTo($request->user(), $reply));
        }
        
        broadcast(new TweetRepliesWereUpdated($tweet));
    }

}
