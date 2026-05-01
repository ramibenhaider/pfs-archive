<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
public function store(Request $request)
    {
        $data = $request->validate([
            'airline_name' => 'required|string|max:70|unique:airlines,airline_name'
        ], [
            'airline_name.required' => 'الاسم مطلوب!',
            'airline_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'airline_name.unique' => 'اسم خط الطيران مكرر!'
        ]);

        $airline = Airline::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إضافة اسم خطوط الطيران بنجاح',
            'data' => $airline
        ], 201);
    }

    public function update(Request $request, $airlineHashed)
    {
    $airlineId = decodeId($airlineHashed);
        
        if (!$airlineId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $airline = Airline::findOrFail($airlineId);

        $new_data = $request->validate([
            'airline_name' => 'required|string|max:70|unique:airlines,airline_name,' . $airline->id,
        ], [
            'airline_name.required' => 'لا يمكن ترك هذه الخانة فارغة!',
            'airline_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'airline_name.unique' => 'اسم خط الطيران مكرر!'
        ]);

        if (!$airline->fill($new_data)->isDirty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'لم تقم بأي تعديل!'
            ],422);
        }

        $airline->save();

        return response()->json([
            'status' => 'success',
            'message' => 'تم التعديل بنجاح!',
            'data' => $airline
        ],200);
    }

    public function destroy($airlineHashed)
    {
        $airlineId = decodeId($airlineHashed);

        if (!$airlineId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $airline = Airline::findOrFail($airlineId);

        if ($airline->employees()->exists()) {
            return response()->json([
                'status' => 'warning', 
                'message' => 'يجب أن لا يكون هناك موظف مرتبط بخط الطيران هذا!'
            ], 400);
        }

        $airline->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف خط الطيران بنجاح'
        ]);
    }
}
