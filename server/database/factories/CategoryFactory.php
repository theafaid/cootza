<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\App\Categories\Domain\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->sentence,
        'slug' => \Str::slug($name),
    ];
});
