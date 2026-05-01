<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document_type;
use App\Models\Document;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::user()->hasPermission('createDocuments')) {
            return response()->json([
                'status' => 'warning',
                'message' => 'غير مصرح لك بإضافة مستند!'
            ],403);
        }

        $document_type = Document_type::find($request->document_type_id);
        if (!$document_type) {
            return response()->json([
                'status' => 'warning',
                'message' => 'نوع الملف هذا غير موجود!'
            ],400);
        }
        
        $request->validate(
            [
                'files' => 'required|array',
                'files.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',

                'employee_id' => 'required|exists:employees,id',
                'document_type_id' => 'required|exists:document_types,id',

                'comments' => 'array',
                'comments.*' => 'nullable|string|max:255',
            ],
            [
                'files.required' => 'يجب رفع ملف واحد على الأقل!',
                'files.*.required' => 'يجب رفع ملف واحد على الأقل!',
                'files.*.file' => 'الملف المرفوع غير صالح!',
                'files.*.mimes' => 'الملفات المدعومة هي: PDF وWord وExcel!',
                'files.*.max' => 'حجم الملف يجب ألا يتجاوز 10 ميجابايت!',

                'employee_id.required' => 'يجب تحديد الموظف!',
                'employee_id.exists' => 'لا يوجد هذا الموظف في قاعدة البيانات!',

                'comments.*.max' => 'لقد تجاوزت الحد المسموح من الحروف!',
            ]
        );
        
        $documents = DB::transaction(function () use ($request, $document_type) {
            $created = [];
            foreach ($request->file('files') as $index => $file) {

                $path = $file->store($document_type->typeEn, 'public');

                $created[] = Document::create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'employee_id' => $request->employee_id,
                    'document_type_id' => $request->document_type_id,
                    'comment' => $request->comments[$index] ?? null,
                ]);
            }
            return $created;
        });

        return response()->json([
            'status' => 'success',
            'message' => 'تم رفع الملفات بنجاح!',
            'data' => $documents
        ],200);
    }


    /**
     * Display the specified resource.
     */
    public function show($employeeHash)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return response()->json([
                'status' => 'warning',
                'message' => 'غير مصرح لك بالإطلاع على المستندات!'
            ], 403);
        }
        $employeeId = decodeId($employeeHash);
        if (!$employeeId) {
            abort(404);
        }
        $employee = Employee::findOrFail($employeeId);
        $documents = Document::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        return response()->json([
            'status' => 'success',
            'data' => [
                'employee' => $employee,
                'documents' => $documents
            ]
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $new_comment = $request->validate([
            'comment' => 'nullable|string|max:255'
        ],
        [
            'comment.max' => 'تم تجاوز الحد المسموح من الأحرف'
        ]);

        if (!$document->fill($new_comment)->isDirty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'لم تقم بأي تعديل!'
            ],422);
        }

        $document->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم التعديل بنجاح'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('deleteDocuments')) {
            return response()->json([
                'status' => 'warning',
                'message' => 'غير مصرح لك بحذف المستندات!'
            ],403);
        }

        $document = Document::findOrFail($id);

        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'تم حذف الملف بنجاح!'
            ],200);
    }

    public function showTypeFiles($employeeHash, $document_typeHash)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return response()->json([
                'status' => 'warning',
                'message' => 'غير مصرح لك بالإطلاع على المستندات!'
            ],403);
        }

        $employeeId = decodeId($employeeHash);
        if (!$employeeId) {
            return abort(404);
        }
        $employee = Employee::findOrFail($employeeId);

        $document_typeId = decodeId($document_typeHash);
        if (!$document_typeId) {
            return abort(404);
        }
        $document_type = Document_type::findOrFail($document_typeId);

        $documents = Document::where('employee_id', $employee->id)
                             ->where('document_type_id', $document_type->id)
                             ->orderByDesc('created_at')->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'employee' => $employee,
                'documents' => $documents
            ]
        ],200);
    }

    public function officePreview($id)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return response()->json([
                'status' => 'warning',
                'message' => 'غير مصرح لك بالإطلاع على المستندات!'
            ],403);
        }

        $document = Document::findOrFail($id);
        $fullpath = storage_path('app/public/' . $document->file_path);

        if (!file_exists($fullpath)) {
            abort(404, 'المستند غير موجود');
        }

        $extension = strtolower(pathinfo($fullpath, PATHINFO_EXTENSION));
        
        $mimeTypes = [
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls'  => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        $contentType = $mimeTypes[$extension] ?? 'application/octet-stream';

        return response()->file($fullpath, [
            'Content-Type' => $contentType,
            'Access-Control-Allow-Origin' => '*',
            'Content-Disposition' => 'inline; filename="' . $document->original_name . '"',
        ]);
    }
}
