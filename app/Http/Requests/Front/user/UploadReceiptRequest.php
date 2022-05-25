<?php

namespace App\Http\Requests\Front\user;

use Illuminate\Foundation\Http\FormRequest;

class UploadReceiptRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'checkbox'  =>'accepted',
            'image'     => 'required|image',
            'amount'    => 'required|numeric',
            'date'      => 'required|date',
            ];
    }
}
