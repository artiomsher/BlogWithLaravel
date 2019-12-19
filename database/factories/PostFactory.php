<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'user_id' => factory(\App\User::class)->create()->id,
        'title' => $faker->sentence,
    ];
});
