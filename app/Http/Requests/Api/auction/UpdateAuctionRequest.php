<?php

namespace App\Http\Requests\Api\auction;

use App\Http\Requests\ApiMasterRequest;
use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateAuctionRequest extends REQUEST_API_PARENT
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

            'name_ar'           => 'sometimes',
            'name_en'           => 'sometimes',
            'category_id'       => 'sometimes',
            'description_ar'    => 'sometimes',
            'description_en'    => 'sometimes',
            'auction_terms_ar'  => 'sometimes',
            'auction_terms_en'  => 'sometimes',
            'latitude'          => 'sometimes',
            'longitude'         => 'sometimes',

            'start_auction_price'        => ['sometimes','numeric'],
            'value_of_increment'         => ['sometimes','numeric'],
            'allowed_take_photo'         => 'sometimes|in:0,1',
            'images.*'                   => 'sometimes',
//            'option_id.*'                => 'sometimes',
            'option_details_id.*'        => 'sometimes',

//            'inspection_report_images.*' => 'sometimes',
            'files.*'                  => 'sometimes',
            'files.*.image'            => ['sometimes','mimes:pdf'],
            'files.*.file_name_id'     => ['sometimes'],
            'files.*.description'      => ['sometimes'],


        ];
    }

}
