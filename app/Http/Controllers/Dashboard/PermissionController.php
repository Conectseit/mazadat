<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PermissionRequest;
use App\Models\Admin_role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index()
    {
        //$permissions = Admin_role::where('id', '>', 1)->get();
        $permissions = Admin_role::all();
        return view('Dashboard.Permissions.index', compact('permissions'));
    }


    public function create()
    {
        return view('Dashboard.Permissions.create');
    }

    public function store(PermissionRequest $request)
    {
        $admin_role = new Admin_role();
        $admin_role->name_ar = $request->name_ar;
        $admin_role->name_en = $request->name_en;
        $admin_role->description_ar = $request->description_ar;
        $admin_role->permissions = json_encode($request->perms);
        $admin_role->save();
        return redirect()->route('permissions.index')->with('success', 'تم اضافة المجموعة بنجاح');
    }


    public function edit($id)
    {
//        if(auth()->guard('admin')->user()->admin_group->id == $id)
//            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));

        if (!Admin_role::find($id) && Admin_role::find($id)->permissions == "*") {
            return back()->with('class', 'alert alert-danger')->with('message', 'لا يمكن تعديل هذة الصلاحية بالنسية لك');
        }
        $role = Admin_role::find($id);

        $this->data['role'] = $role;
        $this->data['perms'] = json_decode($role->permissions);
        return view('Dashboard.Permissions.edit', $this->data);

    }


    public function update(PermissionRequest $request, $id)
    {
        $admin_role = Admin_role::find($id);
        $admin_role->update([
            'name_ar'        => $request->name_ar,
            'name_en'        => $request->name_en,
//            'description_ar' => $request->description_ar,
//            'description_en' => $request->description_en,
            'permissions' => json_encode($request->perms)
        ]);
        return redirect()->route('permissions.index');

    }







    public function destroy(Request $request)
    {
//        if(auth()->guard('admin')->user()->admin_role->id == $request->id)
//            return response()->json(['deleteStatus' => false, 'error' => 'عفوا ,لا يمكنك حذف هذة الصلاحية !!']);


        $admin_role = Admin_role::find($request->id);
        if(!$admin_role) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, User is not exists !!']);
        try
        {
            $admin_role->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        }
        catch (Exception $e){ return response()->json(['deleteStatus' => false,'error' => 'Server Internal Error 500']); }

        return redirect()->route('permissions.index');
    }


}
