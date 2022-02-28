<?php

namespace App\Http\Requests\Api\auction;

use App\Http\Requests\ApiMasterRequest;
use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddAuctionRequest extends REQUEST_API_PARENT
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
    public function rules(Request $request)
    {
        return [
            'name_ar'           => 'required',
            'name_en'           => 'required',
            'category_id'       => 'required',
            'description_ar'    => 'required',
            'description_en'    => 'required',
            'auction_terms_ar'  => 'required',
            'auction_terms_en'  => 'required',
            'latitude'          => 'required',
            'longitude'         => 'required',
//            'start_date'        => 'required',
//            'end_date'          => 'required',
            'start_auction_price'   => ['required','numeric'],
            'value_of_increment'    => ['required','numeric'],
            'allowed_take_photo'    => 'required|in:0,1',
            'images.*'              => 'image',
//            'inspection_report_images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'

        ];
    }

//    public function attributes()
//    {
//        return [
//        ];
//    }
}
