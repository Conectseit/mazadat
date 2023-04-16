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
                        'start_auction_price'   => ['required','numeric'],
                        'value_of_increment' => ['required','numeric'],
//                        'delivery_charge' => ['required','numeric'],
//                        'option_ids.*' => ['required'],
                        'images' => ['required'],
                        'images.*' => ['required','mimes:png,jpg,jpeg'],

//                        'file_name_id'=>['required'],
//                        'inspection_report_images' => ['required'],
//                        'inspection_report_images.*' => ['required','mimes:pdf'],

//                        'inspection_report_images.*' => ['required','mimes:png,jpg,jpeg'],
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
