<?php

namespace App\Http\Requests\Front\user;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name'         => 'required',
            'mobile'            => 'required',
            'email'             => 'required|email',
            'message'           => 'required',
            ];
    }
}
