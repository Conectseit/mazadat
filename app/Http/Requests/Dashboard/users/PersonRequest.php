<?php

namespace App\Http\Requests\Dashboard\users;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
                        'first_name'  => 'required',
                        'middle_name' => 'sometimes',
                        'last_name'   => 'required',
                        'user_name'   => 'required|string|between:2,200|unique:users,user_name',
                        'email'       => 'required|unique:users,email',
//                        'image'       => 'required|image',
                        'image'       => ['sometimes','mimes:png,jpg,jpeg'],

                        'passport_image' => 'required',
                        'password'    => 'required|min:6|confirmed',
                        'mobile'      => 'required|numeric|min:9|unique:users,mobile',
                        'is_appear_name'     => 'required',
                        'nationality_id'     => 'required',
                        'country_id'         => 'required',
                        'city_id'            => 'required',
//                        'gender'      => 'required',
//                        'P_O_Box'      => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'first_name'   => 'sometimes',
                        'last_name'   => 'sometimes',
                        'user_name'   => 'sometimes',
                        'mobile'=>'sometimes|numeric|unique:users,mobile,'.$this->person,
                        'email'=>'sometimes|email|unique:users,email,'.$this->person,
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
