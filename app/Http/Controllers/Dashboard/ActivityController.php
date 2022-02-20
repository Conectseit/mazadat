<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $data['activities']= Activity::all();
        return view('Dashboard.Activities.index', $data);
    }


    public function destroy(Request $request)
    {
        $activity = Activity::find($request->id);

        if (!$activity) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, activity is not exists !!']);
        try {
            $activity->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }
}
