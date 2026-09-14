<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::guard('web')->user()->isAdmin()) {
                return redirect()->route('admin.permissions');
            }

            return redirect()->route('employee.index')->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return back()->withErrors(['username' => 'اسم المستخدم أو كلمة المرور غير صحيحة!'])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
