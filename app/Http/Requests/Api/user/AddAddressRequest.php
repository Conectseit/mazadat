<?php

namespace App\Http\Requests\Api\user;

use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;

class AddAddressRequest extends REQUEST_API_PARENT
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
//            'person_latitude'  => 'required',
//            'person_longitude' => 'required'
            'latitude'  => 'required',
            'longitude' => 'required'
        ];
    }

}
