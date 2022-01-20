<?php

namespace App\Http\Requests\Front\user;

use Illuminate\Foundation\Http\FormRequest;

class AuthContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'message'           => 'required',
            ];
    }
}
