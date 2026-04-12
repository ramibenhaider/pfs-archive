<?php

namespace App\Http\Controllers\Admin;

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
                    return redirect()->back()->with('warning', 'لم يتم إجراء أي تعديلات!');
                }
            return redirect()->back()->with('success', 'تم حفظ الصلاحيات بنجاح');
    }

    public function destroy($idHashed)
    {
        $id = decodeId($idHashed);
        if (!$id) {
            abort(404);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'تم حذف المستخدم بنجاح');
    }
}
