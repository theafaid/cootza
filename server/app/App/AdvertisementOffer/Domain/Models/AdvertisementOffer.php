<?php

namespace App\App\AdvertisementOffer\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementOffer extends Model
{
    protected $fillable = [
        'user_id', 'offer', 'advertisement_id', 'swap_approved'
    ];
}
