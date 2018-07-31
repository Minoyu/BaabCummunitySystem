<?php

use Faker\Generator as Faker;

$factory->define(App\Model\News::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'user_id' => 4,
        'news_category_id' => 2,
    ];
});
