<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends REQUEST_API_PARENT
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
//            'image'            => 'sometimes|image',
//            'type'             => 'required|in:buyer,seller',
            'is_company'       => 'required|in:person,company',

//            'nationality_id'    => 'required|numeric|exists:nationalities,id',
//            'city_id'          => 'required|numeric|exists:cities,id',
            'first_name'       => 'required|string|between:2,200',
            'middle_name'      => 'sometimes|string|between:2,200',
            'last_name'        => 'required|string|between:2,200',
            'email'            => 'required|email|max:100|unique:users,email',
            'country_id'       => 'required|numeric|exists:countries,id',
            'phone_code'       => 'required',
            'mobile'           => 'required|numeric|min:9|unique:users,mobile',
            'user_name'        => 'required|string|between:2,200',
            'password'         => 'required|string|min:6|confirmed',

            'commercial_register_image'        => 'required_if:is_company,company|image',
            'latitude'         => 'required_if:is_company,company|numeric',
            'longitude'        => 'required_if:is_company,company|numeric',

        ];
    }
}
