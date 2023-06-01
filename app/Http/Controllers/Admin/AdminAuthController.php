<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\session;
use App\Events\AdminLoggedIn;
use Illuminate\Support\Facades\Event;

class AdminAuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $validatedData = $this->validate($request, [
            'admin_id'    => 'required',
            'password' => 'required',
        ]);
        $adminId = $validatedData['admin_id'];
        $adminPassword = $validatedData['password'];
        $admin = Admin::where('admin_id', $adminId)
            ->where('password', $adminPassword)
            ->first();
        if ($admin) {
            Event::dispatch(new AdminLoggedIn($admin));
            return redirect('admin/dashboard');
        }
        else {
            return redirect()->back()->withErrors(['message' => 'Invalid credentials']);

        }
    }


    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout successfully');

        return redirect(route('home'));
    }
//}
}
