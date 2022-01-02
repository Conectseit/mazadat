<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class REQUEST_API_PARENT extends FormRequest
{
    public function expectsJson()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        // $data['field'] = $validator->errors()->keys()[0];
//        $data['status'] = "validation_errors";
        $data['status'] = false;
        $data['message'] = $validator->errors()->first();
        $data['data'] = null;
        throw new HttpResponseException(response()->json($data, JsonResponse::HTTP_OK)); // 200
//        throw new HttpResponseException(response()->json($data, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)); // 422
    }
}
