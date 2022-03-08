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
        return [

            'nationality_id'        => 'required|numeric|exists:nationalities,id',
            'city_id'               => 'required|numeric|exists:cities,id',
            'block'                 => 'required|string',
            'street'                => 'required|string',
            'block_num'             => 'required|numeric',
//            'delivery_time'         => 'required|in:am,pm',
            'signs'                 => 'required',
            'P_O_Box'               => 'required',
            'passport_image'        => 'required|image',

        ];
    }
}
