<?php

namespace App\App\AdvertisementOffer\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementOffer extends Model
{
    protected $fillable = [
        'provided_to', 'offered_by', 'offer', 'swap_approved'
    ];
}
