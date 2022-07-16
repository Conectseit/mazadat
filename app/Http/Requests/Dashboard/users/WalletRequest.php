<?php

namespace App\Http\Requests\Dashboard\users;

use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'wallet'       => 'required|numeric',
            'note'         => 'required',
        ];
    }


}
