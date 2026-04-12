<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validattion\Rule;

class DashboardController extends Controller
{

    public function index()
    {
        //
    }

    public function register()
    {
        return view('user.registerUser');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string','regex:/^[a-zA-Z]+$/', 'unique:users,username'],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ],
        [
            'name.required' => 'الاسم مطلوب!',

            'username.required' => 'اسم المستخدم مطلوب!',
            'username.unique' => 'اسم المستخدم موجود في قاعدة البيانات!',
            'username.regex' => 'يجب أن يكون اسم المستخدم من حروف انجليزية فقط ومن دون مسافات!',

            'password.required' => 'كلمة المرور مطلوبة!',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل من 4 خانات!',
            'password.confirmed' => 'كلمتا المرور غير متطابقتان!'
        ]);

        User::create ([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'is_active' => false
        ]);

        return redirect()->route('login')->with('success', 'تم إرسال طلبك بنجاح، في انتظار موافقة الأدمن!');
    }

}
