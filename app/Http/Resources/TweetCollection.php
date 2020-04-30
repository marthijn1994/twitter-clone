<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TweetCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = TweetResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'meta' => [
                'likes' => $this->likes($request),
                'retweets' => $this->retweets($request)
            ]
        ];
    }

    /**
     * @param $request
     * @return array
     */
    protected function likes($request): array
    {
        if (!$user = $request->user()) {
            return [];
        }

        return $user->likes()
            ->whereIn(
                'tweet_id',
                $this->collection->pluck('id')->merge(
                    $this->collection->pluck('original_tweet_id')
                )
            )
            ->pluck('tweet_id')
            ->toArray();
    }

    /**
     * @param $request
     * @return array
     */
    protected function retweets($request): array
    {
        if (!$user = $request->user()) {
            return [];
        }

        return $user->retweets()
            ->whereIn(
                'original_tweet_id',
                $this->collection->pluck('id')->merge(
                    $this->collection->pluck('original_tweet_id')
                )
            )
            ->pluck('original_tweet_id')
            ->toArray();
    }

}
