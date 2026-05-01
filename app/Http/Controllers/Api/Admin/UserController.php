<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'users' => 'required|array',
            'users.*.id' => 'required|exists:users,id'
        ],
        [
            'users.*.id.exists' => 'المستخدم المراد تعديله غير موجود!'
        ]);

        $permissions = Permission::pluck('id', 'name');
        $hasChanged = false;

        foreach($request->users as $userData)
        {
            $user = User::find($userData['id']);
            $isActive = isset($userData['is_active']) ? 1 : 0;

            if ($user->is_active != $isActive)
            {
                $hasChanged = true;
                $user->update(['is_active' => $isActive]);
            }

            $newPermissionIds = [];
            if ($isActive == 1)
            {
                foreach ($permissions as $name => $id)
                    if (isset($userData[$name]))
                    {
                        $newPermissionIds[] = $id;
                    }
            }
            $oldPermissionIds = $user->permissions->pluck('id')->sort()->values()->toArray();
            $newPermissionIds = collect($newPermissionIds)->sort()->values()->toArray();

            if ($newPermissionIds != $oldPermissionIds)
            {
                $hasChanged = true;
                $user->permissions()->sync($newPermissionIds);
            }
        }
        
        if (!$hasChanged)
        {
            return response()->json([
                'status' => 'warning',
                'message' => 'لم يتم إجراء أي تعديلات!'
            ], 422);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم حفظ الصلاحيات بنجاح'
        ], 200);
    }

    public function destroy($idHashed)
    {
        $id = decodeId($idHashed);
        if (!$id) {
            return response()->json([
                'status' => 'warning',
                'message' => 'المستخدم غير موجود!'
            ], 404);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف المستخدم بنجاح'
        ], 200);
    }
}
