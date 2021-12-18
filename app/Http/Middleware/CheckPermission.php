<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = auth()->guard('admin')->user();

        if (!auth()->guard('admin')->check()) return redirect('/show_login');

        if ($admin->admin_role_id == 1) return $next($request);

        $currentRoute = $request->route()->getName();

        $adminPermissions = json_decode($admin->admin_role->permissions);

        if (!in_array($currentRoute, $adminPermissions))
//            abort(510);
            return back()->with('class', 'danger')->with('message', trans('messages.messages.sorry_you_dont_have_permission'));

        if ($admin->admin_role->permissions == "")
            return back()->with('class', 'danger')->with('message', trans('messages.messages.sorry_you_dont_have_permission'));

        return $next($request);
    }
}
