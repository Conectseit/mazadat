<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class updateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name'        => 'sometimes|string|max:255',
//            'user_name'        => 'sometimes|string|max:255',
//            'nationality_id'   => 'sometimes|numeric|exists:nationalities,id',
////            'country_id'       => 'sometimes|numeric|exists:countries,id',
//            'city_id'          => 'sometimes|numeric|exists:cities,id',
            'mobile'           => 'sometimes|string|unique:users,mobile,'.auth()->user()->id,
            'email'            => 'sometimes|email|max:255|unique:users,email,'. auth()->user()->id,
//            'password'         => 'sometimes|string|min:6',
            'password'    => 'required|min:6|confirmed',


        ];
    }
}
