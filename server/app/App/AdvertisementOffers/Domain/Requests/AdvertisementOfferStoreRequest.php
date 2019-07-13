<?php

namespace App\App\AdvertisementOffers\Domain\Requests;

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
        return ! $this->route('advertisement')->ownedBy(auth()->user());
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

            'offer.advertisements.*' => ['nullable', 'numeric','distinct', 'exists:advertisements,id'],

            'offer.money' => [
                Rule::requiredIf(
                    is_null($this['offer.advertisements']) || empty($this['offer.advertisements'])
                ), 'present', 'nullable', 'numeric', 'min:1'
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
