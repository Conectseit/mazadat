<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
//                        'category_id' => 'required',
                        'city_id' => 'required',
                        'district_ar' => 'required',
                        'district_en' => 'required',
                        'street_ar' => 'required',
                        'street_en' => 'required',
                        'property_facade_ar' => 'required',
                        'property_facade_en' => 'required',
                        'space' => ['required', 'numeric'],
                        'purpose' => 'required',
                        'price_per_meter_of_land' => ['required', 'numeric'],
                        'unit_price' => ['required', 'numeric'],
                        'property_type_ar' => 'required',
                        'property_type_en' => 'required',
                        'age_of_the_property' => 'required',
                        'services_related_ar' => 'required',
                        'services_related_en' => 'required',
                        'purpose_of_the_advertisement' => 'required',
                        'image' => 'required',
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
