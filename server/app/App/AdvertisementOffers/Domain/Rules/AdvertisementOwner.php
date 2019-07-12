<?php

namespace App\App\AdvertisementOffers\Domain\Rules;

use App\App\Advertisements\Domain\Models\Advertisement;
use Illuminate\Contracts\Validation\Rule;

class AdvertisementOwner implements Rule
{
    protected $user;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Advertisement::findOrFail($value)->ownedBy($this->user);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('site.dont_own_this_ad');
    }
}
