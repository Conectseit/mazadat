<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OptionDetailRequest;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OptionDetailController extends Controller
{

    public function index()
    {
         $data['option_details'] = OptionDetail::latest()->paginate(200);
        return view('Dashboard.OptionDetails.index', $data);
    }


    public function create()
    {
        $data['latest_option_details'] = OptionDetail::orderBy('id', 'desc')->take(5)->get();
        $data['options'] = Option::all();
        return view('Dashboard.OptionDetails.create', $data);
    }

    public function store(OptionDetailRequest $request)
    {
         $option= OptionDetail::create($request->all());
        return back()->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
//        return redirect()->route('option_details.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }

    public function show($id)
    {
        //
    }


    public function destroy(Request $request)
    {
        $option = OptionDetail::find($request->id);
        if (!$option) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, OptionDetail is not exists !!']);
        try {
            $option->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }


}
