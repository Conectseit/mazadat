<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class ComplteProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return  [

            'nationality_id'        => 'required|numeric|exists:nationalities,id',
            'city_id'               => 'required|numeric|exists:cities,id',
            'block'                 => 'required_if:is_company,person|string',
            'street'                => 'required_if:is_company,person|string',
            'block_num'             => 'required_if:is_company,person|numeric',
//            'delivery_time'         => 'required_if:is_company,person|in:am,pm',
            'signs'                 => 'required_if:is_company,person|string',
            'P_O_Box'               => 'required',
            'passport_image'        => 'required_if:is_company,==,person|image',

        ];
//        if(auth()->user->is_company== 'person'){
//
//        }

//        return $rule;
    }
}
