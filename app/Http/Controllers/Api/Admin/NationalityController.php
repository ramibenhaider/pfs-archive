<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nationality;

class NationalityController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nationality_name' => 'required|string|max:30|unique:nationalities,nationality_name'
        ], [
            'nationality_name.required' => 'الاسم مطلوب!',
            'nationality_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'nationality_name.unique' => 'الجنسية مكررة!'
        ]);

        $nationality = Nationality::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إضافة اسم الجنسية بنجاح',
            'data' => $nationality
        ], 201);
    }

    public function update(Request $request, string $nationalityHashed)
    {
        $nationalityId = decodeId($nationalityHashed);
        
        if (!$nationalityId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $nationality = Nationality::findOrFail($nationalityId);

        $new_data = $request->validate([
            'nationality_name' => 'required|string|max:30|unique:nationalities,nationality_name,' . $nationality->id,
        ], [
            'nationality_name.required' => 'لا يمكن ترك هذه الخانة فارغة!',
            'nationality_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'nationality_name.unique' => 'الجنسية مكررة!'
        ]);

        if (!$nationality->fill($new_data)->isDirty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'لم تقم بأي تعديل!'
            ], 422);
        }

        $nationality->save();

        return response()->json([
            'status' => 'success',
            'message' => 'تم التعديل بنجاح',
            'data' => $nationality
        ]);
    }

    public function destroy(string $nationalityHashed)
    {
        $nationalityId = decodeId($nationalityHashed);

        if (!$nationalityId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $nationality = Nationality::findOrFail($nationalityId);

        if ($nationality->employees()->exists()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'يجب أن لا يكون هناك موظف مرتبط بهذه الجنسية!'
            ], 400);
        }

        $nationality->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف الجنسية بنجاح'
        ]);
    }
}
