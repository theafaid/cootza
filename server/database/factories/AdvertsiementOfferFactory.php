<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\App\AdvertisementOffer\Domain\Models\AdvertisementOffer::class, function (Faker $faker) {
    return [
        'advertisement_id' => factory(\App\App\Advertisements\Domain\Models\Advertisement::class)->create(),
        'user_id' => factory(\App\Generic\Domain\Models\User::class)->create(),
        'offer' => json_encode(['advertisements' => [], 'additional_money' => '10']),
        'swap_approved' => false
    ];
});
