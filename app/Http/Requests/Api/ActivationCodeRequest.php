<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;

class ActivationCodeRequest extends REQUEST_API_PARENT
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'mobile' => 'required|exists:users,mobile',
            'activation_code' => 'required'
        ];
    }

//    public function attributes()
//    {
//        return [
//            'activation_code' => 'كود التفعيل',
//        ];
//    }
}
