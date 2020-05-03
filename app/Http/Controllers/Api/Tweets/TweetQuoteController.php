<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetRetweetsWereUpdated;
use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class TweetQuoteController extends Controller
{

    /**
     * @param Tweet $tweet
     * @param Request $request
     */
    public function store(Tweet $tweet, Request $request)
    {
        $quotedTweet = $request->user()->tweets()->create([
            'type' => TweetType::QUOTE,
            'body' => $request->body,
            'original_tweet_id' => $tweet->id
        ]);

        broadcast(new TweetWasCreated($quotedTweet));
        broadcast(new TweetRetweetsWereUpdated($request->user(), $tweet));
    }

}
