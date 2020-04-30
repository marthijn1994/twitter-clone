<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Tweet::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create(),
        'body' => $faker->sentence(15),
        'type' => \App\Tweets\TweetType::TWEET,
    ];
});
