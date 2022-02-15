<?php

namespace App\Http\Requests\Api\company;

use App\Http\Requests\ApiMasterRequest;
use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateCompanyProfileRequest extends REQUEST_API_PARENT
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
    public function rules(Request $request)
    {
        return [
            'user_name'        => 'sometimes|string|max:255',
            'country_id'       => 'sometimes|numeric|exists:countries,id',
            'phone_code'       => 'sometimes',
            'is_appear_name'   => 'sometimes|in:0,1',
            'mobile'           => 'sometimes|string|min:9|max:255|unique:users,mobile,'.auth()->user()->id,
            'email'            => 'sometimes|email|max:255|unique:users,email,'. auth()->user()->id,
            'image_logo'       => 'sometimes|image',
            'latitude'         => 'sometimes',
            'longitude'        => 'sometimes',
            'commercial_register_image'   => 'sometimes|image',
            'company_authorization_image'   => 'sometimes|image',
        ];
    }

}
