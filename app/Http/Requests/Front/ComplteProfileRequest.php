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

            'nationality_id'        => 'sometimes|numeric|exists:nationalities,id',
            'city_id'               => 'sometimes|numeric|exists:cities,id',
            'block'                 => 'sometimes|string',
            'street'                => 'sometimes|string',
            'block_num'             => 'sometimes|numeric',
//            'delivery_time'         => 'sometimes|in:am,pm',
            'signs'                 => 'sometimes',
            'P_O_Box'               => 'sometimes',
            'passport_image'        => 'sometimes|image',

        ];
    }
}
