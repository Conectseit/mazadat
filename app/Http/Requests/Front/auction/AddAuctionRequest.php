<?php

namespace App\Http\Requests\Front\auction;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class AddAuctionRequest extends FormRequest
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
                        'name_ar' => 'required',
                        'name_en' => 'required',
                        'category_id' => 'required',
                        'description_ar' => 'required',
                        'description_en' => 'required',
                        'auction_terms_ar' => 'required',
                        'auction_terms_en' => 'required',
//                        'start_date' => 'required',
//                        'end_date' => 'required',
//                        'start_auction_price'   => ['required','numeric'],
//                        'value_of_increment' => ['required','numeric'],
//                        'delivery_charge' => ['required','numeric'],
//                        'images.*' => 'image',
//                        'inspection_report_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ];

            }
            case 'PUT':
            case 'PATCH': {
                    return [
//                        'name_ar' => 'required',
//                        'name_en' => 'required'
                    ];
                }
            default:
                break;
        }
    }

    public function attributes()
    {
        return [

        ];
    }
}