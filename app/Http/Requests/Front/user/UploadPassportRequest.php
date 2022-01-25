<?php

namespace App\Http\Requests\Front\user;

use Illuminate\Foundation\Http\FormRequest;

class UploadPassportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'passport_image'     => 'required|image',
            'passport_expiry_date'      => 'required|date',
            ];
    }
}
