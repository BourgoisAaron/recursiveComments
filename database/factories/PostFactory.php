<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'author' => $faker->name,
        'text' => $faker->text(1000),
        'title' => $faker->words(4, true),
    ];
});
