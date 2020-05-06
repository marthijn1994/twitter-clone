<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Api'], function() {
    Route::get('/timeline', 'Timeline\TimelineController@index');

    Route::post('/tweets', 'Tweets\TweetController@store');

    Route::post('/tweets/{tweet}/likes', 'Tweets\TweetLikeController@store');
    Route::delete('/tweets/{tweet}/likes', 'Tweets\TweetLikeController@destroy');

    Route::post('/tweets/{tweet}/retweets', 'Tweets\TweetRetweetController@store');
    Route::delete('/tweets/{tweet}/retweets', 'Tweets\TweetRetweetController@destroy');

    Route::post('/tweets/{tweet}/replies', 'Tweets\TweetReplyController@store');

    Route::post('/tweets/{tweet}/quotes', 'Tweets\TweetQuoteController@store');

    Route::post('/media', 'Media\MediaController@store');
    Route::get('/media/types', 'Media\MediaTypesController@index');
});

