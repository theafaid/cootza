<?php

namespace App\App\Auth\Domain\Requests;

use App\Http\Requests\BaseFormRequest;

class UserRegisterFormRequest extends BaseFormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|confirmed|string|min:6|max:255',
        ];
    }

    /**
     * Filters to be applied to the input
     */
    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
            'name'  => 'capitalize',
        ];
    }
}
