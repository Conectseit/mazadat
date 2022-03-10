<?php

namespace App\Http\Requests\Api\company;

use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;

class RegisterCompanyRequest extends REQUEST_API_PARENT
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
            'commercial_register_image'          => 'required|image',
            'company_authorization_image'        => 'required|image',
            'latitude'         => 'required|numeric',
            'longitude'        => 'required_if:is_company,company|numeric',
            'user_name'        => 'required|string|between:2,200|unique:users',
            'email'            => 'required|email|max:100|unique:users,email',
            'country_id'       => 'required|numeric|exists:countries,id',
            'phone_code'       => 'required',
            'mobile'           => ['required', 'numeric', 'min:9', 'unique:users,mobile'],
            'password'         => 'required|string|min:6|confirmed',
//            'fcm'              => 'required',
        ];
    }

    public function getValidatorInstance()
    {
        // here
    }
}
