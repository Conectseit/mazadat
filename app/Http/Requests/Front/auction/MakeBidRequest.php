<?php

namespace App\Http\Requests\Front\auction;

use Illuminate\Foundation\Http\FormRequest;

class MakeBidRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'buyer_offer'            => 'required',
        ];
    }
}
