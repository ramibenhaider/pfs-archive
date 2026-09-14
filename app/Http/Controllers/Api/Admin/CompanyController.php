<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:70|unique:companies,company_name'
        ], [
            'company_name.required' => 'الاسم مطلوب!',
            'company_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'company_name.unique' => 'اسم خط الطيران مكرر!'
        ]);

        $company = Company::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إضافة اسم خطوط الطيران بنجاح',
            'data' => $company
        ], 201);
    }

    public function update(Request $request, $companyHashed)
    {
    $companyId = decodeId($companyHashed);
        
        if (!$companyId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $company = Company::findOrFail($companyId);

        $new_data = $request->validate([
            'company_name' => 'required|string|max:70|unique:companies,company_name,' . $company->id,
        ], [
            'company_name.required' => 'لا يمكن ترك هذه الخانة فارغة!',
            'company_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'company_name.unique' => 'اسم خط الطيران مكرر!'
        ]);

        if (!$company->fill($new_data)->isDirty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'لم تقم بأي تعديل!'
            ],422);
        }

        $company->save();

        return response()->json([
            'status' => 'success',
            'message' => 'تم التعديل بنجاح!',
            'data' => $company
        ],200);
    }

    public function destroy($companyHashed)
    {
        $companyId = decodeId($companyHashed);

        if (!$companyId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $company = Company::findOrFail($companyId);

        if ($company->employees()->exists()) {
            return response()->json([
                'status' => 'warning', 
                'message' => 'يجب أن لا يكون هناك موظف مرتبط بخط الطيران هذا!'
            ], 400);
        }

        $company->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف خط الطيران بنجاح'
        ]);
    }
}
