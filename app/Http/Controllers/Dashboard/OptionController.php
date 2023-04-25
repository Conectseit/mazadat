<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OptionRequest;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OptionController extends Controller
{

    public function store(OptionRequest $request)
    {
         $option= Option::create($request->all());
        return back()->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
//        return redirect()->route('options.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }

    public function edit($id)
    {
        if (!Option::find($id)) {
            return redirect()->route('options.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
//        $data['latest_options'] = Option::orderBy('id', 'desc')->take(5)->get();
        $data['option'] = Option::find($id);
        return view('Dashboard.Options.edit', $data);
    }


    public function update(OptionRequest $request,$id)
    {
        $option= Option::where('id',$id)->first();

//        $option = Option::find($request->option_id);
//        Option::find($option_id)->update($request->all());
        $option->update($request->all());
        return back()->with('success', 'تم تعديل القسم بنجاح');
    }


    public function destroy(Request $request)
    {
        $option = Option::find($request->id);
        if (!$option) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Option is not exists !!']);
        try {
            $option->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }


}
