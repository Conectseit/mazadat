<?php

namespace App\Http\Requests\Front\auction;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'option_detail_id'            => 'required',
        ];
    }
}
