<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'يجب إدخال اسم مستخدم الأدمن!',
            'password.required' => 'يجب إدخال كلمة المرور!',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'بيانات دخول الأدمن غير صحيحة!',
            ], 401);
        }

        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        if (!$admin->isAdmin()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'لا تملك صلاحية الدخول!',
            ], 403);
        }

        $token = $admin->createToken('admin-api-token')->plainTextToken;

        return response()->json([
            'status'  => 'success',
            'token'   => $token,
            'admin'   => $admin,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'تم تسجيل خروج الأدمن بنجاح!',
        ]);
    }
}