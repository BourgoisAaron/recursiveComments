<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    static $commentId = 1;
    return [
        //
        'comment_id' => $commentId++,
        'author' => $faker->name,
        'text' => $faker->text(100),
        'title' => $faker->words(4, true),
    ];
});
