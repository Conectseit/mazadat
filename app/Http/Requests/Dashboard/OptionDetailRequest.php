<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OptionDetailRequest extends FormRequest
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
                        'value_ar' => 'required',
                        'value_en' => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'value_ar' => 'required',
                        'value_en' => 'required'
                    ];
                }
            default:
                break;
        }
    }

    public function attributes()
    {
        return [
            'value_ar' => ' الاسم بالعربيه',
            'value_en' => ' الاسم بالانجليزية',
        ];
    }
}
