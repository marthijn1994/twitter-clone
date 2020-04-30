<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\MediaStoreRequest;
use App\Http\Resources\TweetMediaCollection;
use App\Media\MimeTypes;
use App\TweetMedia;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    /**
     * MediaController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    /**
     * @param Request $request
     * @return TweetMediaCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(MediaStoreRequest $request): TweetMediaCollection
    {
        $result = collect($request->media)->map(function ($media) {
            return $this->addMedia($media);
        });

        return new TweetMediaCollection($result);
    }

    /**
     *
     */
    protected function addMedia($media)
    {
        $tweetMedia = TweetMedia::create([]);

        $tweetMedia->baseMedia()
            ->associate($tweetMedia->addMedia($media)->toMediaCollection())
            ->save();

        return $tweetMedia;
    }

}
