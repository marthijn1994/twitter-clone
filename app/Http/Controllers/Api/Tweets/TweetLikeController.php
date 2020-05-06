<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetLikesWereUpdated;
use App\Http\Controllers\Controller;
use App\Tweet;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{

    /**
     * TweetLikeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    /**
     * @param Tweet $tweet
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Tweet $tweet, Request $request)
    {
        if ($request->user()->hasLiked($tweet)) {
            return response(null, 409);
        }

        $request->user()->likes()->create([
            'tweet_id' => $tweet->id
        ]);

        broadcast(new TweetLikesWereUpdated($request->user(), $tweet));
    }

    /**
     * @param Tweet $tweet
     * @param Request $request
     */
    public function destroy(Tweet $tweet, Request $request)
    {
        $request->user()->likes()->where('tweet_id', $tweet->id)->first()->delete();

        broadcast(new TweetLikesWereUpdated($request->user(), $tweet));
    }

}
