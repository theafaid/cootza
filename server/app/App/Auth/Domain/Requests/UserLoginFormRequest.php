<?php

namespace App\App\Auth\Domain\Requests;

use App\Generic\Domain\Requests\BaseFormRequest;

class UserLoginFormRequest extends BaseFormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',
        ];
    }

    /**
     * Filters to be applied to the input
     */
    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
            'password'  => 'trim',
        ];
    }
}
