<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\App\Advertisements\Domain\Models\Advertisement::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->sentence,
        'slug'  => \Str::slug($title),
        'description' => $faker->paragraph(30),
        'category_id' => factory(\App\App\Categories\Domain\Models\Category::class)
    ];
});
