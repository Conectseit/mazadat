<?php

namespace App\Http\Requests\Front\user;

use Illuminate\Foundation\Http\FormRequest;

class AdditionalAddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'person_latitude'     => 'required',
            'person_longitude'     => 'required',
            ];
    }
}
