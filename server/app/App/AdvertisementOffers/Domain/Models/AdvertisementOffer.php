<?php

namespace App\App\AdvertisementOffers\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementOffer extends Model
{
    protected $fillable = [
        'provided_to', 'provided_by', 'content', 'swap_approved'
    ];
}
