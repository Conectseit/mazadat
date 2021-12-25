<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index()
    {
        $data['countries'] = Country::latest()->paginate(200);
        return view('Dashboard.Countries.index', $data);
    }

    public function create()
    {
        $data['latest_countries'] = Country::orderBy('id', 'desc')->take(10)->get();
        return view('Dashboard.Countries.create', $data);
    }

    public function store(CountryRequest $request)
    {
         $country= Country::create($request->all());
        return redirect()->route('countries.index')->with('message', trans('messages.messages.added_successfully'));
    }

    public function edit($id)
    {
        if (!Country::find($id)) {
            return redirect()->route('dashboard.region.index')->with('class', 'danger')->with('message', trans('message.messages.try_2_access_not_found_content'));
        }
        $data['latest_countries'] = Country::orderBy('id', 'desc')->take(5)->get();
        $data['country'] = Country::find($id);
        return view('Dashboard.Countries.edit', $data);
    }

    public function update(CountryRequest $request, $id)
    {
        Country::findOrFail($id)->update($request->all());
        return redirect()->route('countries.index')->with('success',trans('messages.messages.updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $country = Country::find($request->id);
        if (!$country) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Country is not exists !!']);
        try {
            $country->delete();
            return response()->json(['deleteStatus' => true, 'message' =>  trans('messages.messages.deleted_successfully')]);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

}
