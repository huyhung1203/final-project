<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('admin');
        } else {
            return view('admin.login');
        }
        
    }

    public function login(Request $request)
    {
        $remember = ($request->remember) ? true : false;
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return Redirect::route('admin.index');
        } 
        else {
            return back()->with('fail', 'Email hoặc mật khẩu không đúng');
        }
    }

    public function logout(Request $request)
    {   
        Auth::guard('admin')->logout();
        return redirect('admin/login');   
        
    }
}
