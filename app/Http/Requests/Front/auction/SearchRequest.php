<?php

namespace App\Http\Requests\Front\auction;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search'            => 'required',
        ];
    }
}
