<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\App\AdvertisementOffer\Domain\Models\AdvertisementOffer::class, function (Faker $faker) {
    return [
        'provided_to' => factory(\App\App\Advertisements\Domain\Models\Advertisement::class)->create(),
        'offered_by' => factory(\App\Generic\Domain\Models\User::class)->create(),
        'offer' => json_encode(['advertisements' => [], 'additional_money' => '10']),
        'swap_approved' => false
    ];
});
