<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FileNameRequest;
use App\Models\FileName;
use App\Models\Country;
use Illuminate\Http\Request;

class InspectionFileNameController extends Controller
{

    public function index()
    {
        $data['inspection_file_names'] = FileName::latest()->paginate(10);
        return view('Dashboard.inspection_file.index', $data);
    }

    public function create()
    {
        $data['latest_inspection_file_names'] = FileName::orderBy('id', 'desc')->take(10)->get();
        $data['countries'] = Country::all();

        return view('Dashboard.inspection_file.create', $data);
    }

    public function store(Request $request)
    {
          FileName::create($request->all());
        return redirect()->route('inspection_file_names.index')->with('message', trans('messages.messages.added_successfully'));
    }

    public function edit($id)
    {
        if (!FileName::find($id)) {
            return redirect()->route('dashboard.region.index')->with('class', 'danger')->with('message', trans('message.messages.try_2_access_not_found_content'));
        }
        $data['city'] = FileName::find($id);
        return view('Dashboard.inspection_file.edit', $data);
    }

    public function update(FileNameRequest $request, $id)
    {
        // FileName::findOrFail($id)->first()->fill($request->all())->save();
        FileName::findOrFail($id)->update($request->all());
        return redirect()->route('inspection_file_names.index')->with('success', 'تم تعديل  بنجاح');
    }

    public function destroy(Request $request)
    {
        $city = FileName::find($request->id);
        if (!$city) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, FileName is not exists !!']);
        try {
            $city->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

}
