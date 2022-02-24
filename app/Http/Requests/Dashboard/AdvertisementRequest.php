<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
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
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'image'   => 'required|image',
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


    public function attributes()
    {
        return [
            'name_ar' => ' الاسم بالعربيه',
            'name_en' => ' الاسم بالانجليزية',
            'description_ar' => ' الوصف بالعربيه',
            'description_en' => ' الوصف بالانجليزية',
            'image' => 'الصورة',
            'auction_commission' => 'رسوم دخول المزاد لهذا القسم يجب ان تكون رقم',
        ];
    }
}
