<?php

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'body' => $faker->sentence
    ];
});
