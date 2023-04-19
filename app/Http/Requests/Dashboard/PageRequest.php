<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name_ar' => 'bail|required',
                    'name_en' => 'required',
//                    'description_ar' => 'required',
//                    'description_en' => 'required',
//                    'image'   => 'required|image',


                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name_ar' => 'sometimes',
                    'name_en' => 'sometimes',
                    'image' => 'sometimes',
                ];
            }
            default:
                break;
        }

    }
}
