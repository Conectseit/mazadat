<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\NationalityRequest;
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
        return view('Dashboard.Nationalities.create', $data);
    }

    public function store(NationalityRequest $request)
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
        return view('Dashboard.Nationalities.edit', $data);
    }

    public function update(NationalityRequest $request, $id)
    {
        Nationality::findOrFail($id)->update($request->all());
        return redirect()->route('nationalities.index')->with('message', trans('messages.messages.updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $nationality = Nationality::find($request->id);
        if (!$nationality) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, nationality is not exists !!']);
        try {
            $nationality->delete();
            return response()->json(['deleteStatus' => true, 'message' =>"تم الحذف بنجاح"]);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

}
