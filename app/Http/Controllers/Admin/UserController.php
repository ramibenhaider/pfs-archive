<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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

        $hasChanged = false;

        foreach ($request->users as $userData) {
            $user = User::find($userData['id']);

        $isActive = isset($userData['is_active']) ? 1 : 0;

            $columns = [
                'createEmployee', 
                'updateEmployee', 
                'deleteEmployee', 
                'createDoc', 
                'showDoc', 
                'deleteDoc'
            ];

            $updateData = ['is_active' => $isActive];

            foreach ($columns as $col) {

                $newValue = ($isActive == 1) ? (isset($userData[$col]) ? 1 : 0) : 0;

                if ($user->$col != $newValue) {
                    $hasChanged = true;
                }

                $updateData[$col] = $newValue;
            }

            if ($user->is_active != $isActive) {
                $hasChanged = true;
            }

            $user->update($updateData);
        }

        if (!$hasChanged) {
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

        return back()->with('success', 'تم حذف الموظف بنجاح');
    }
}
