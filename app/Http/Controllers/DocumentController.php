<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        DB::transaction(function () use ($request) {

            foreach ($request->file('files') as $index => $file) {

                // حفظ الملف
                $path = $file->store('uploads', 'public');

                // إنشاء سجل لكل ملف
                Document::create([
                    'file_path' => $path,
                    'employee_id' => $request->employee_id,
                    'document_type_id' => $request->document_type_id,
                    'comment' => $request->comments[$index] ?? null,
                ]);
            }
        });

        return back()->with('success', 'تم رفع الملفات بنجاح');
    }


    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // حذف الملف من Storage أولاً
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        // ثم حذف الـ record من DB
        $document->delete();

        return back()->with('success', 'تم حذف الملف بنجاح');
    }
}
