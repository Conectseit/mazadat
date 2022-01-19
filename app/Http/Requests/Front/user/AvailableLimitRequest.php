<?php

namespace App\Http\Requests\Front\user;

use Illuminate\Foundation\Http\FormRequest;

class AvailableLimitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'available_limit'            => 'sometimes',
        ];
    }
}
