<?php

namespace Modules\General\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    /**
     * Display login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('general::admin.auth.login');
        // return view('general::index');
    }

    /**
     * Login admin.
     *
	 * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        // return "dg";
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard.home');
        } else {
        	$credentials = $request->validate([
	            'name' => 'required|min:2',
	            'password' => 'required|min:6',
	        ]);

	        $credentials['admins_status'] = '1';
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.dashboard.home');
            } else {
		        request()->flash();
            	if (Auth::guard('admin')->validate([
            		'name' => request('name'), 'password' => request('password'), 'admins_status' => '0'
            	])) {
			        return back()->with('status_danger', __('general::lang.inactiveAccount'));
			    }
                return back()->with('status_danger', __('general::lang.wrongCredentials'));
            }
        }
    }

	/**
	 * Logout user.
	 *
	 * @return Response
	 */
	public function logout()
	{
		Auth::guard('admin')->logout();

		return back();
	}
}
