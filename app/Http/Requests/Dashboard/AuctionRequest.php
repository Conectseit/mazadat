<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class AuctionRequest extends FormRequest
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
                        'seller_id' => 'required',
                        'category_id' => 'required',
                        'description_ar' => 'required',
                        'description_en' => 'required',
                        'auction_terms_ar' => 'required',
                        'auction_terms_en' => 'required',

                        'start_date'  => ['required','date','after_or_equal:'. now()->format('Y-m-d H:i:s')],
                        'end_date'    =>  'required|date|after:start_date',
                        'start_auction_price'   => ['required','numeric'],
                        'value_of_increment' => ['required','numeric'],
                        'delivery_charge' => ['required','numeric'],


                        'is_appear_location'=> 'required|in:0,1',
                        'latitude'          => 'required_if:is_appear_location,1',
                        'longitude'         => 'required_if:is_appear_location,1',

//                        'address'         => 'required',
                        'extra'           => 'sometimes|max:2048',
//                        'extra'           => 'sometimes|mimes:pdf|max:2048',
//                        'latitude'         => 'required|numeric',
                        'option_ids' => ['required'],
                        'option_ids.*' => ['required'],





                        'images' => ['required'],
                        'images.*' => ['required'],
//                        'images.*' => ['required','mimes:png,jpg,jpeg'],

                        'file_name_id'=>['required'],
//                        'inspection_report_images' => ['required'],
//                        'inspection_report_images.*' => ['required'],

//                        'inspection_report_images.*' => ['required','mimes:pdf'],
                    ];

            }


            case 'PUT':
            case 'PATCH': {
                    return [

                        'start_date'  => ['required','date','after_or_equal:'. now()->format('Y-m-d H:i:s')],
                        'end_date'    =>  'required|date|after:start_date',
                        'delivery_charge' => ['required','numeric'],
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
//                        'longitude'        => 'required|numeric',
//                        'images.*' => 'image',
//                        'inspection_report_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
