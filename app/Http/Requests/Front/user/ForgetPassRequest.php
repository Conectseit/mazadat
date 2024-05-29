<?php

namespace App\Http\Requests\Front\user;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPassRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//            'email'             => 'required',
            'mobile'      => 'required|min:9|numeric|unique:users,mobile',
            ];
    }
}
