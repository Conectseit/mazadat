<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $data['cities'] = City::latest()->paginate(200);
        return view('Dashboard.Cities.index', $data);
    }

    public function create()
    {
        $data['latest_cities'] = City::orderBy('id', 'desc')->take(10)->get();
        return view('Dashboard.Cities.create', $data);
    }

    public function store(CityRequest $request)
    {
         $city= City::create($request->all());
        return redirect()->route('cities.index')->with('message', trans('messages.messages.added_successfully'));
    }

    public function edit($id)
    {
        if (!City::find($id)) {
            return redirect()->route('dashboard.region.index')->with('class', 'danger')->with('message', trans('message.messages.try_2_access_not_found_content'));
        }
        $data['latest_cities'] = City::orderBy('id', 'desc')->take(5)->get();
        $data['city'] = City::find($id);
        return view('Dashboard.Cities.edit', $data);
    }

    public function update(CityRequest $request, $id)
    {
        // City::findOrFail($id)->first()->fill($request->all())->save();
        City::findOrFail($id)->update($request->all());
        return redirect()->route('cities.index')->with('success', 'تم تعديل  بنجاح');
    }

    public function destroy(Request $request)
    {
        $city = City::find($request->id);
        if (!$city) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, City is not exists !!']);
        try {
            $city->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

}
