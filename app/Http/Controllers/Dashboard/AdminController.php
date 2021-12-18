<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Models\Admin;
use App\Models\Admin_role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data['admins'] = Admin::paginate(200);
        return view('Dashboard.Admins.index', $data);
    }

    public function create()
    {
        $data['latest_admins'] = Admin::orderBy('id', 'desc')->take(5)->get();
        $data['admin_roles'] = Admin_role::all();
        return view('Dashboard.Admins.create', $data);
    }

    public function store(AdminRequest $request)
    {

        $admin = new Admin();
        $admin->full_name = $request->full_name;
        $admin->admin_role_id = $request->admin_role_id;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->password = $request->password;
        $admin->save();
        return redirect()->route('admins.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));

    }


    public function edit($id)
    {
        if (!Admin::find($id)) {
            return redirect()->route('admins.index')->with('class', 'danger')->with('message', trans('messages.messages.try_2_access_not_found_content'));
        }
        $data['latest_admins'] = Admin::orderBy('id', 'desc')->take(5)->get();
        $data['admin'] = Admin::find($id);
        $data['admin_roles'] = Admin_role::all();

        return view('Dashboard.Admins.edit', $data);
    }

    public function update(AdminRequest $request, $id)
    {
        Admin::findOrFail($id)->update($request->all());
        return redirect()->route('admins.index')->with('success', 'تم تعديل  بنجاح');
    }



    public function destroy(Request $request)
    {
        $admin = Admin::find($request->id);

        if (!$admin) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Admin is not exists !!']);
        try {
            $admin->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }

        return redirect()->route('admins.index');
    }

}
