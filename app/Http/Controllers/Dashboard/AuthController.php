<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Models\Admin;
use Faker\Provider\File;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('Dashboard.auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $remember = isset($request['remember']) ? $request['remember'] : false;
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

            return redirect()->route('admin.home')->with('success', 'Admin Login Successfully');
        }
        return back()->with('error', 'Invaild Email Or Password')->with('class', 'alert-danger');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }


//========= Auth Profile ====================

    public function showProfile()
    {
        $data['admin'] = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        return view('Dashboard.Auth.show_profile', $data);
    }


//    public function UpdateProfile(adminRequest $request, Admin $admin)
    public function UpdateProfile(adminRequest $request, $id)
    {
        $request_data = $request->except(['password', 'password_confirmation', 'image', 'submit']);

        if ($request->hasFile('image')) {
//            File::delete('uploads/admins/' . $request->image);
            $request_data['image'] = uploaded($request->image, 'admin');
        }
        $admin = Admin::find($id)->update($request_data);
        return redirect()->route('admin.showProfile')->with('success', 'تم تعديل بنجاح');
    }


}
