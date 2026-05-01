<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document_type;
use Illuminate\Support\Facades\Storage;

class DocumentTypeController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'type'   => 'required|string|max:50|unique:document_types,type',
            'typeEn' => 'required|string|regex:/^[a-zA-Z]+$/|max:50|unique:document_types,typeEn'
        ], [
            'type.required'   => 'الاسم مطلوب!',
            'type.max'        => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'type.unique'     => 'هذا الاسم مكرر باللغة العربية!',
            'typeEn.required' => 'الاسم مطلوب!',
            'typeEn.max'      => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'typeEn.regex'    => 'يجب أن تكون هذه الخانة بحروف انجليزية فقط!',
            'typeEn.unique'   => 'هذا الاسم مكرر باللغة الانجليزية!'
        ]);

        Storage::disk('public')->makeDirectory($request->typeEn);

        $documentType = Document_type::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'تم إضافة اسم نوع المستند بنجاح',
            'data'    => $documentType
        ], 201);
    }

    public function update(Request $request, string $document_typeHashed)
    {
        $document_typeDecoded = DecodeId($document_typeHashed);
        
        if (!$document_typeDecoded) {
            return response()->json(['status' => 'warning', 'message' => 'معرف غير صالح'], 404);
        }

        $document_type = Document_type::findOrFail($document_typeDecoded);

        $new_data = $request->validate([
            'type' => 'required|string|max:50|unique:document_types,type,' . $document_type->id,
        ], [
            'type.required' => 'لا يمكن ترك هذه الخانة فارغة!',
            'type.max'      => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'type.unique'   => 'هذا الاسم مكرر باللغة العربية!'
        ]);

        if (!$document_type->fill($new_data)->isDirty()) {
            return response()->json([
                'status'  => 'warning',
                'message' => 'لم تقم بأي تعديل!'
            ], 422); 
        }

        $document_type->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'تم التعديل بنجاح',
            'data'    => $document_type
        ]);
    }

    public function destroy($document_typeHashed)
    {
        $document_typeDecoded = DecodeId($document_typeHashed);

        if (!$document_typeDecoded) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $document_type = Document_type::findOrFail($document_typeDecoded);

        if ($document_type->documents()->exists()) {
            return response()->json([
                'status'  => 'warning',
                'message' => 'يجب أن لا يكون هناك مستند مرتبط بهذا النوع!'
            ], 400);
        }

        Storage::disk('public')->deleteDirectory($document_type->typeEn);

        $document_type->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'تم حذف نوع المستند بنجاح'
        ]);
    }
}
