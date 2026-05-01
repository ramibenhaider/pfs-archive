<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'يجب إدخال اسم المستخدم!',
            'password.required' => 'يجب إدخال كلمة المرور!',
        ]);

        if (!Auth::guard('web')->attempt($credentials)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'اسم المستخدم أو كلمة المرور غير صحيحة!',
            ], 401);
        }

        $user  = Auth::guard('web')->user();
        $user = $request->user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token'  => $token,
            'user'   => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'تم تسجيل الخروج بنجاح!',
        ]);
    }

    public function register(Request $request)
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

        $registered_data = User::create ([
                            'name' => $data['name'],
                            'username' => $data['username'],
                            'password' => bcrypt($data['password']),
                            'is_active' => false
                        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إرسال طلبك بنجاح، في انتظار موافقة الأدمن!',
            'data' => $registered_data
        ]);
    }
}
