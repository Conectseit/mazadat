<?php

namespace App\Http\Requests\Dashboard\users;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'commercial_register_image'          => 'required|image',
                        'company_authorization_image'        => 'required|image',
                        'latitude'         => 'required|numeric',
                        'longitude'        => 'required_if:is_company,company|numeric',
                        'user_name'        => 'required|string|between:2,200',
                        'email'            => 'required|email|max:100|unique:users,email',
                        'country_id'       => 'required|numeric|exists:countries,id',
                        'mobile'           => 'required|numeric|min:9|unique:users,mobile',
                        'password'         => 'required|string|min:6|confirmed',
                        'image'            => 'sometimes|image',
                        'nationality_id'   => 'required',
                        'city_id'          => 'required',
                        'P_O_Box'          => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'user_name'   => 'sometimes',
                        'mobile'=>'sometimes|numeric|unique:users,mobile,'.$this->company,
                        'email'=>'sometimes|email|unique:users,email,'.$this->company,

                        // 'gender'=>'sometimes|in:male,female',
                        // 'gender'=>'sometimes|in:male,female',
                        'password'=>'sometimes|confirmed',
//                        'city_id'=>'sometimes|numeric|exists:city,id',
//                        'address'=>'sometimes',
                        'image'=>'nullable',

                    ];
                }
            default:
                break;
        }
    }

    public function attributes()
    {
        return [
//            'full_name' => ' يرجي ادخال الاسم بالكامل ',
//            'user_name' => ' يرجي ادخال اسم المستخدم',
//            'email' => ' يرجي ادخال البريد الالكتروني',
//            'image' => ' يرجي ادخال صورة العميل',
//            'password' => ' يرجي ادخال كلمة المرور',
//            'mobile' => ' يرجي ادخال رقم الجوال',
//            'is_appear_name' => ' يرجي ادخال هل الاسم ظاهر او مختفي',
//            'gender' => ' يرجي ادخال النوع ',
        ];
    }
}
