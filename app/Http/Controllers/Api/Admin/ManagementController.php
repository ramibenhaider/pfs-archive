<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Management;

class ManagementController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'management_name' => 'required|string|max:30|unique:management,management_name'
        ], [
            'management_name.required' => 'الاسم مطلوب!',
            'management_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'management_name.unique' => 'اسم الإدارة مكرر!'
        ]);

        $management = Management::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إضافة اسم الإدارة بنجاح',
            'data' => $management
        ], 201);
    }

    public function update(Request $request, string $managementHashed)
    {
        $managementId = decodeId($managementHashed);
        
        if (!$managementId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $management = Management::findOrFail($managementId);

        $new_data = $request->validate([
            'management_name' => 'required|string|max:30|unique:management,management_name,' . $management->id,
        ], [
            'management_name.required' => 'لا يمكن ترك هذه الخانة فارغة!',
            'management_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'management_name.unique' => 'اسم الإدارة مكرر!'
        ]);

        if (!$management->fill($new_data)->isDirty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'لم تقم بأي تعديل!'
            ], 422);
        }

        $management->save();

        return response()->json([
            'status' => 'success',
            'message' => 'تم التعديل بنجاح!',
            'data' => $management
        ]);
    }

    public function destroy(string $managementHashed)
    {
        $managementId = decodeId($managementHashed);

        if (!$managementId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $management = Management::findOrFail($managementId);

        if ($management->employees()->exists()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'يجب أن لا يكون هناك موظف مرتبط بهذه الإدارة!'
            ], 400);
        }

        $management->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف الإدارة بنجاح'
        ]);
    }
}
