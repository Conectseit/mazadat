<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'                => 'required|string',
            'password'             => 'required|string',
//            'g-recaptcha-response' => 'required|captcha'

        ];


    }


}
