<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
                        'full_name'   => 'required',
                        'email'       => 'required|unique:admins,email',
                        'image'       => 'sometimes|image',
                        'password'    => 'required|min:6|confirmed',
                        'mobile'      => ['required', 'numeric', 'unique:admins,mobile'],
                        'admin_role_id'     => 'required',

                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'full_name'   => 'sometimes',
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
            'name_ar' => ' الاسم بالعربيه',
            'name_en' => ' الاسم بالانجليزية',
        ];
    }
}
