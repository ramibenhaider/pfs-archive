<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Document_type;
use App\Models\Document;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

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
        if (!Auth::user()->hasPermission('createDocuments')) {
            return back()->with('warning', 'غير مصرح لك بإضافة موظف!');
        }

        $document_type = Document_type::find($request->document_type_id);
        if (!$document_type) {
            return back()->with('warning', 'نوع الملف هذا غير موجود!');
        }
        
        $request->validateWithBag('doc_errors',
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
        
        DB::transaction(function () use ($request, $document_type) {

            foreach ($request->file('files') as $index => $file) {

                $path = $file->store($document_type->typeEn, 'public');

                Document::create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'employee_id' => $request->employee_id,
                    'document_type_id' => $request->document_type_id,
                    'comment' => $request->comments[$index] ?? null,
                ]);
            }
        });

        return back()->with('success', 'تم رفع الملفات بنجاح!');
    }


    /**
     * Display the specified resource.
     */
    public function show($employeeHash)
    {
        $employeeId = decodeId($employeeHash);
        if (!$employeeId) {
            abort(404);
        }
        $employee = Employee::findOrFail($employeeId);
        $documents = Document::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        return view('user.document.show', compact('documents', 'employee'));
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
        $new_comment = $request->validate([
            'comment' => 'nullable|string|max:255'
        ],
        [
            'comment.max' => 'تم تجاوز الحد المسموح من الأحرف'
        ]);

        if (!$document->fill($new_comment)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل');
        }

        $document->save();
        return redirect()->back()
             ->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('deleteDocuments')) {
            return back()->with('warning', 'غير مصرح لك بحذف المستند');
        }

        $document = Document::findOrFail($id);

        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'تم حذف الملف بنجاح!');
    }

        public function showTypeFiles($employeeHash,$document_typeHash)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return back()->with('warning', 'غير مصرح لك بالإطلاع على المستندات!');
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
        return view('user.document.show', compact('documents', 'employee'));
    }

    public function preview($path)
    {
        if (!Auth::user()->hasPermission('previewDocuments')) {
            return back()->with('warning', 'أنت غير مصرح لك بمعاينة المستندات');
        }

        $fullpath = storage_path('app/public/' . $path);

        if (!file_exists($fullpath)) {
            abort(404);
        }

        return response()->file($fullpath);
    }
}
