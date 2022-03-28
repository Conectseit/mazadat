<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class AddStartDateAuctionRequest extends FormRequest
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

        return [

            'start_date'  => ['required','date','after_or_equal:'. now()->format('Y-m-d H:i:s')],
//         'start_date'  => 'required|date_format:Y-m-d|after:today',
            'end_date'    =>  'required|date|after:start_date',
            'delivery_charge' => ['required','numeric'],
        ];
    }
}
