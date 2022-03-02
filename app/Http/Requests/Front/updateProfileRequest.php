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

            'first_name'       => 'sometimes|string|max:255',
            'middle_name'      => 'sometimes|string|max:255',
            'last_name'        => 'sometimes|string|max:255',
            'user_name'        => 'sometimes|string|max:255|unique:users,user_name,'.auth()->user()->id,
            'country_id'       => 'sometimes|numeric|exists:countries,id',
            'phone_code'       => 'sometimes',
            'is_appear_name'   => 'sometimes|in:0,1',
            'mobile'           => 'sometimes|string|min:9|max:255|unique:users,mobile,'.auth()->user()->id,
            'email'            => 'sometimes|email|max:255|unique:users,email,'. auth()->user()->id,
            'image'            => 'sometimes|image',
            'password'         => 'required|min:6|confirmed',

        ];
    }
}


//            'user_name'        => 'sometimes|string|max:255',
//            'nationality_id'   => 'sometimes|numeric|exists:nationalities,id',
////            'country_id'       => 'sometimes|numeric|exists:countries,id',
//            'city_id'          => 'sometimes|numeric|exists:cities,id',
//            'password'         => 'sometimes|string|min:6',
