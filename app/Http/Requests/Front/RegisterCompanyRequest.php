<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCompanyRequest extends FormRequest
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

                        'commercial_register_image'        => 'required|image',
                        'company_authorization_image'      => 'required|image',
                        'g-recaptcha-response'             => 'required|captcha',
                        'latitude'    => 'required',
                        'longitude'   => 'required',
                        'user_name'   => 'required|string|between:2,200|unique:users,user_name',
//                        'country_id'  => 'required|numeric|exists:countries,id',
                        'mobile'      => 'required|numeric|min:9|unique:users,mobile',
                        'email'       => 'required|unique:users,email',
                        'password'    => 'required|min:6|confirmed',



                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
//                        'full_name'   => 'sometimes',
                        'user_name'   => 'sometimes',
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

//                        'longitude'      => 'required_if:is_company,company',
//                        'first_name'   => 'required',
//                        'middle_name'   => 'sometimes',
//                        'last_name'   => 'required',
//                        'is_company'       => 'required|in:person,company',
//                        'mobile'      => ['required', 'numeric', 'unique:users,mobile'],
//                        'is_appear_name'     => 'required',
//                        'nationality_id'     => 'required',
//                        'city_id'            => 'required',
////                        'gender'           => 'required',
//                        'P_O_Box'            => 'required',
//                        'commercial_register_image'        => 'required_if:is_company,company|image',
