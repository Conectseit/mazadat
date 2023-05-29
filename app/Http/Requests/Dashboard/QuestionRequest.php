<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
                        'question_ar' => 'required',
                        'question_en' => 'required',
                        'replay_ar' => 'required',
                        'replay_en' => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'question_ar' => 'required',
                        'question_en' => 'required',
                        'replay_ar' => 'required',
                        'replay_en' => 'required'

                    ];
                }
            default:
                break;
        }
    }

    public function attributes()
    {
        return [
            'question_ar' => ' السؤال بالعربيه',
            'question_en' => ' السؤال بالانجليزية',
        ];
    }
}
