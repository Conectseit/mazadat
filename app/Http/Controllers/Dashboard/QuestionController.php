<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\QuestionRequest;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $this->data['questions'] = CommonQuestion::all();
        return view('Dashboard.Questions.index', $this->data);
    }


    public function create()
    {
        $this->data['latest_questions'] = CommonQuestion::orderBy('id', 'desc')->take(5)->get();
        return view('Dashboard.Questions.create', $this->data);
    }

    public function store(QuestionRequest $request)
    {
        $question = CommonQuestion::create($request->all());
        return redirect()->route('questions.index')->with('message', trans('messages.messages.added_successfully'));
    }


    public function edit($id)
    {
        $data['latest_questions'] = CommonQuestion::orderBy('id', 'desc')->take(5)->get();
        $data['question'] = CommonQuestion::find($id);
        return view('Dashboard.Questions.edit', $data);
    }

    public function update(QuestionRequest $request, $id)
    {
        CommonQuestion::findOrFail($id)->update($request->all());
        return redirect()->route('questions.index')->with('success', trans('messages.messages.updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $jquestion = CommonQuestion::find($request->id);
        if (!$jquestion) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, CommonQuestion is not exists !!']);
        try {
            $jquestion->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }


}
