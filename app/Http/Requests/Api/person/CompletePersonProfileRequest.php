<?php

namespace App\Http\Requests\Api\person;

use App\Http\Requests\ApiMasterRequest;
use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CompletePersonProfileRequest extends REQUEST_API_PARENT
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

            'nationality_id'        => 'required|numeric|exists:nationalities,id',
            'city_id'               => 'required|numeric|exists:cities,id',
            'block'                 => 'required',
            'street'                => 'required',
            'block_num'             => 'required',
            'delivery_time'         => 'required|in:am,pm',
            'signs'                 => 'required',
            'P_O_Box'               => 'required',
            'passport_image'        => 'sometimes',

        ];
    }

//    public function attributes()
//    {
//        return [
//            'mobile' => 'رقم الجوال ',
//        ];
//    }
}
