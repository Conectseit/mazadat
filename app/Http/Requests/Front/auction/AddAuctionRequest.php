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
    protected $userType;

    public function authorize()
    {
        return true;
    }
    public function __construct()
    {
        $this->userType = auth()->user()->is_company;
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
                        'name_of_the_licensor' => 'required_if:userType,person',
                        'license_number' => 'required_if:userType,person',
                        'brokerage_license_number' => 'required_if:userType,company',
                        'auction_terms_ar' => 'required',
                        'auction_terms_en' => 'required',
//                        'start_date' => 'required',
//                        'end_date' => 'required',
                        'start_auction_price'   => ['required','numeric'],
                        'value_of_increment' => ['required','numeric'],

                        'is_appear_location'=> 'required|in:0,1',
                        'latitude'          => 'required_if:is_appear_location,1',
                        'longitude'         => 'required_if:is_appear_location,1',

//                        'delivery_charge' => ['required','numeric'],
                        'option_ids' => ['required'],
                        'option_ids.*' => ['required'],
//
                        'images' => ['required'],
                        'images.*' => ['required','mimes:png,jpg,jpeg'],

//                        'files.*'                  => 'required',
//                      'files.*.image'              => ['required','mimes:pdf'],
////                        'files.*.image'            => ['required'],
//                        'files.*.file_name_id'     => ['required'],
//                        'files.*.description'      => ['required'],
                        'file_name_ids'=>['required'],
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
