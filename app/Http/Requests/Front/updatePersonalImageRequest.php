<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class updatePersonalImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image'            => 'sometimes|image|mimes:jpg,png,jpeg',
        ];
    }
}
