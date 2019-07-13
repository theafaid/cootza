<?php

namespace App\App\AdvertisementOffers\Domain\Requests;

use App\App\AdvertisementOffers\Domain\Rules\AdvertisementOwner;
use App\Generic\Domain\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class AdvertisementOfferStoreRequest extends BaseFormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();
        $advertisement = $this->route('advertisement');

        return ! $advertisement->ownedBy($user) && ! $user->hasMadeOfferFor($advertisement);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'offer.advertisements' => [
                Rule::requiredIf(is_null($this['offer.money'])),'nullable', 'present', 'array'
            ],

            'offer.advertisements.*' => ['nullable', 'numeric','distinct', new AdvertisementOwner(auth()->user())],

            'offer.money' => [
                Rule::requiredIf(
                    is_null($this['offer.advertisements']) || empty($this['offer.advertisements'])
                ), 'present', 'nullable', 'numeric', 'min:1', 'max:25000000'
            ]
        ];
    }

    /**
     * Filters to be applied to the input
     */
    public function filters()
    {
        return [
//            'offer.advertisements' => 'cast:array',
            'offer.money' => 'trim|escape'
        ];
    }

    public function messages()
    {
        return [
            'offer.advertisements.required' => __('site.advertisements_is_required'),
            'offer.advertisements.*' => __('site.invalid_advertisement'),
        ];
    }
}
