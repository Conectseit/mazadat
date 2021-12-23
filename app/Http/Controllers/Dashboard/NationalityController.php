<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\nationalityRequest;
use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{

    public function index()
    {
        $data['nationalities'] = Nationality::latest()->paginate(200);
        return view('Dashboard.Nationalities.index', $data);
    }

    public function create()
    {
        $data['latest_nationalities'] = Nationality::orderBy('id', 'desc')->take(10)->get();
        return view('Dashboard.Cities.create', $data);
    }

    public function store(nationalityRequest $request)
    {
         $nationality= Nationality::create($request->all());
        return redirect()->route('nationalities.index')->with('message', trans('messages.messages.added_successfully'));
    }

    public function edit($id)
    {
        if (!nationality::find($id)) {
            return redirect()->route('dashboard.region.index')->with('class', 'danger')->with('message', trans('message.messages.try_2_access_not_found_content'));
        }
        $data['latest_nationalities'] = Nationality::orderBy('id', 'desc')->take(5)->get();
        $data['nationality'] = Nationality::find($id);
        return view('Dashboard.Cities.edit', $data);
    }

//    public function update(nationalityRequest $request, $id)
//    {
//        // nationality::findOrFail($id)->first()->fill($request->all())->save();
//        Nationality::findOrFail($id)->update($request->all());
//        return redirect()->route('nationalities.index')->with('success', 'تم تعديل  بنجاح');
//    }

    public function destroy(Request $request)
    {
        $nationality = Nationality::find($request->id);
        if (!$nationality) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, nationality is not exists !!']);
        try {
            $nationality->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

}
