<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdvertisementRequest;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    public function index()
    {
        $data['advertisements'] = Advertisement::all()->paginate(100);

        return view('Dashboard.Advertisements.index', $data);
    }

    public function create()
    {
        $data['latest_advertisements'] = Advertisement::orderBy('id', 'desc')->take(5)->get();
        return view('Dashboard.Advertisements.create', $data);
    }

    public function store(AdvertisementRequest $request)
    {
        $request_data = $request->except(['image']);

        if ($request->image) $request_data['image'] = uploaded($request->image, 'advertisement');
        $advertisement = Advertisement::create($request_data);
// ===========================================================
        $name='name_' . app()->getLocale();
        activity()
            ->performedOn($advertisement)
            ->causedBy(auth()->guard('admin')->user())
            ->log(' قام المشرف' . ' '.auth()->guard('admin')->user()->full_name .' '. ' باضافة اعلان جديد '. ($advertisement->$name));
// ===========================================================

        return redirect()->route('advertisements.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));

    }


    public function edit($id)
    {
        if (!Advertisement::find($id)) {
            return redirect()->route('advertisements.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['latest_advertisements'] = Advertisement::orderBy('id', 'desc')->take(5)->get();
        $data['advertisement'] = Advertisement::find($id);
        return view('Dashboard.advertisements.edit', $data);
    }


    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        $request_data = $request->except('image');
        if ($request->hasFile('image')) {
            if (!is_null($advertisement->image)) unlink('uploads/advertisements/' . $advertisement->image);
            $request_data['image'] = uploaded($request->image, 'advertisement');
        }
        $advertisement->update($request_data);
        return redirect()->route('advertisements.index')->with('success', trans('messages.messages.updated_successfully'));
    }

    public function destroy(Request $request, Advertisement $advertisement)
    {
        $advertisement = Advertisement::find($request->id);
        if (!$advertisement) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Category is not exists !!']);
        try {
            if (!is_null($advertisement->image)) unlink('uploads/advertisements/' . $advertisement->image);
            $advertisement->delete();

// ===========================================================
            $name='name_' . app()->getLocale();
            activity()
                ->performedOn($advertisement)
                ->causedBy(auth()->guard('admin')->user())
                ->log(' قام المشرف' . ' '.auth()->guard('admin')->user()->full_name .' '. ' بحذف اعلان '. ($advertisement->$name));
// ===========================================================

            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }
}
