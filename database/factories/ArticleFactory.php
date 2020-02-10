<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'article_title' => $faker->text(30),
        'article_excerpt' => $faker->text(70),
        'article_content' => $faker->text(300),
        'article_name' => $faker->slug(),
        'article_status' => $faker->numberBetween(0,1),
        'article_guid' => $faker->url(),
    ];
});
