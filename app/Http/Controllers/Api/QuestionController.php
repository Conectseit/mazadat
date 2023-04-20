<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\user\ContactRequest;
use App\Http\Requests\Api\user\ContactUsRequest;
use App\Http\Resources\Api\QuestionsResource;
use App\Models\CommonQuestion;
use App\Models\Contact;
use Illuminate\Http\Request;

class QuestionController extends PARENT_API
{
    public function index()
    {
        $questions = CommonQuestion::all();
        return responseJson(true, trans('api.all_questions'),QuestionsResource::collection($questions) );  //OK don-successfully
    }


    public function contact_us(ContactUsRequest $request)
    {
        $contact = Contact::create($request->all());
        return responseJson(true, trans('api.message_send_successfully'),$contact );
    }

    public function auth_contact(ContactRequest $request)
    {
        $contact = Contact::create($request->all()+[
            'full_name'=>auth()->user()->full_name,
            'mobile'=>auth()->user()->mobile,
            'email'=>auth()->user()->email,
            ]);
        return responseJson(true, trans('api.message_send_successfully'),$contact );
    }

}
