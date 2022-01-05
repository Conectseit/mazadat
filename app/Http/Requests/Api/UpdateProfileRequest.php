<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiMasterRequest;
use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateProfileRequest extends REQUEST_API_PARENT
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
    public function rules(Request $request)
    {
        return [
            'full_name'        => 'sometimes|string|max:255',
            'user_name'        => 'sometimes|string|max:255',
            'nationality_id'   => 'sometimes|numeric|exists:nationalities,id',
//            'country_id'       => 'sometimes|numeric|exists:countries,id',
            'city_id'          => 'sometimes|numeric|exists:cities,id',
            'address '         => 'sometimes|string|max:255',
            'mobile'           => 'sometimes|string|min:9|max:255|unique:users,mobile,'.auth()->user()->id,
            'email'            => 'sometimes|email|max:255|unique:users,email,'. auth()->user()->id,
            'P_O_Box'          => 'sometimes|string|max:255',
            'bio'              => 'sometimes|string|max:255',
            'image'            => 'sometimes|image',

            'latitude'         => 'sometimes',
            'longitude'        => 'sometimes',
            'commercial_register_image'   => 'sometimes|image',
        ];
    }

//    public function attributes()
//    {
//        return [
//            'mobile' => 'رقم الجوال ',
//        ];
//    }
}
