<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\session;


class AdminAuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'admin_id'    => 'required',
            'password' => 'required',
        ]);
        //$user= Auth()->user();
        if (1) {
            return redirect()->intended(route('adminDashboard'));
        }
        else {
            return redirect()->back()->withErrors(['message' => 'Invalid credentials']);

        }
    }


//    public function postLogin(Request $request)
//    {
//        $this->validate($request, [
//            'adminId'    => 'required',
//            'password' => 'required',
//        ]);
//        $credentials = $request->only('adminId', 'password');
//
//        if (Auth::guard('admin')->attempt($credentials)) {
//            // Admin authentication successful
//            return redirect()->intended(route('adminDashboard'));
//        } else {
//            // Admin authentication failed
//            return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
//        }
//
//        // if (auth()->guard('admin')->attempt(['adminId'    => $request->input('adminId'),
//        //                                      'password' => $request->input('password')
//        // ])) {
//        //     dd(1);
//        //     $user = auth()->guard('admin')->user();
//        //     if ($user->is_admin == 1) {
//        //         return redirect()->route('adminDashboard')->with('success', 'You are Logged in successfully.');
//        //     }
//        // } else {
//        //     dd('here');
//        //     return back()->with('error', 'Whoops! invalid adminId and password.');
//        // }
//    }
//
    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout successfully');

        return redirect(route('home'));
    }
//}
}
