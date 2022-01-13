<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiMasterRequest;
use App\Http\Requests\REQUEST_API_PARENT;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DocumentRequest extends REQUEST_API_PARENT
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
            'expiry_date'               => 'required|date',
            'document_name'             => 'required|string',
            'Id_type'                   => 'required|numeric',
            'front_side_image'          => 'required|image|mimes:jpg,png,jpeg',
            'back_side_image'           => 'sometimes|image|mimes:jpg,png,jpeg',
        ];
    }

}
