<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validattion\Rule;

class DashboardController extends Controller
{

    public function index()
    {
        if (auth()->user() && !auth()->user()->is_active) {
            return redirect()->route('user.unactivated');
        }
        
        $employee = Employee::orderBy('created_at', 'desc')->paginate(6);
        return view('user.employee.index', compact('employee'));
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

    public function makeSearch(Request $request)
    {
        $search = $request->search;
        $normalizedSearch = str_replace(['آ', 'أ', 'إ'], 'ا', $search);
        $employee = DB::table('employees')
            ->where(function ($query) use ($normalizedSearch, $search) {
                $query->whereRaw("REPLACE(REPLACE(REPLACE(
                            name,'آ','ا'), 'أ','ا'), 'إ','ا') LIKE ?", ["%$normalizedSearch%"])
                    ->orWhere('job_number', 'LIKE', $search . '%')
                    ->orWhere('id_number', 'LIKE', $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('user.employee.index', compact('employee'));
    }

    public function unactivated()
    {
        return view('user.unactivated');
    }
}
