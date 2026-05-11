<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company_document_type;
use App\Models\Company_document;
use App\Models\Airline;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class CompanyDocumentController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return redirect()->route('employee.index')->with('warning', 'غير مصرح لك بعرض مستندات الشركات!');
        }

        $airlines = Airline::with('company_documents')->orderByDesc('created_at')->get();
        $company_document_types = Company_document_type::orderByDesc('created_at')->get();
        return view('user.company-docs.index', compact('airlines', 'company_document_types'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return redirect()->route('employee.index')->with('warning', 'غير مصرح لك بعرض مستندات الشركات!');
        }

        if (!Auth::user()->hasPermission('createDocuments')) {
            return back()->with('warning', 'غير مصرح لك بإضافة مستندات!');
        }

        $company_document_type = Company_document_type::find($request->company_document_type_id);
        if (!$company_document_type) {
            return back()->with('warning', 'نوع الملف هذا غير موجود!');
        }
        
        $request->validateWithBag('company_doc_errors',
            [
                'files' => 'required|array',
                'files.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',

                'airline_id' => 'required|exists:airlines,id',
                'company_document_type_id' => 'required|exists:company_document_types,id',

                'comments' => 'array',
                'comments.*' => 'nullable|string|max:255',
            ],
            [
                'files.required' => 'يجب رفع ملف واحد على الأقل!',
                'files.*.required' => 'يجب رفع ملف واحد على الأقل!',
                'files.*.file' => 'الملف المرفوع غير صالح!',
                'files.*.mimes' => 'الملفات المدعومة هي: PDF وWord وExcel!',
                'files.*.max' => 'حجم الملف يجب ألا يتجاوز 10 ميجابايت!',

                'airline_id.required' => 'يجب تحديد الشركة!',
                'airline_id.exists' => 'لا يوجد هذه الشركة في قاعدة البيانات!',

                'company_document_type_id.required' => 'يجب تحديد نوع المستند!',
                'company_document_type_id.exists' => 'لا يوجد هذا النوع في قاعدة البيانات!',

                'comments.*.max' => 'لقد تجاوزت الحد المسموح من الحروف!',
            ]
        );
        
        DB::transaction(function () use ($request, $company_document_type) {

            foreach ($request->file('files') as $index => $file) {

                $path = $file->store($company_document_type->nameEn, 'public');

                Company_document::create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'airline_id' => $request->airline_id,
                    'company_document_type_id' => $request->company_document_type_id,
                    'comment' => $request->comments[$index] ?? null,
                ]);
            }
        });

        return back()->with('success', 'تم رفع الملفات بنجاح!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $airlineHash)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return redirect()->route('employee.index')->with('warning', 'غير مصرح لك بالإطلاع على المستندات!');
        }

        $airlineId = decodeId($airlineHash);
        if (!$airlineId) {
            abort(404);
        }
        $airlines = Airline::all();
        $company_document_types = Company_document_type::all();
        $airline = Airline::findOrFail($airlineId);
        $company_documents = Company_document::where('airline_id', $airline->id)->orderByDesc('created_at')->get();
        return view('user.company-docs.show', compact('company_documents', 'airline', 'airlines', 'company_document_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return redirect()->route('employee.index')->with('warning', 'غير مصرح لك بالإطلاع على المستندات!');
        }

        $document = Company_document::findOrFail($id);

        $new_comment = $request->validate([
            'comment' => 'nullable|string|max:255',
            'airline_id' => 'required|exists:airlines,id',
            'company_document_type_id' => 'required|exists:company_document_types,id'
        ],
        [
            'comment.max' => 'تم تجاوز الحد المسموح من الأحرف',

            'airline_id.required' => 'يجب تحديد الشركة!',
            'airline_id.exists' => 'لا توجد هذه الشركة في قاعدة البيانات!',

            'company_document_type_id.required' => 'يجب تحديد نوع المستند!',
            'company_document_type_id.exists' => 'لا يوجد هذا النوع في قاعدة البيانات!',
        ]);

        if (!$document->fill($new_comment)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل');
        }

        $document->save();
        return redirect()->back()->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return redirect()->route('employee.index')->with('warning', 'غير مصرح لك بالإطلاع على المستندات!');
        }
        
        if (!Auth::user()->hasPermission('deleteDocuments')) {
            return back()->with('warning', 'غير مصرح لك بحذف المستند');
        }

        $document = Company_document::findOrFail($id);

        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'تم حذف المستند بنجاح!');
    }

        public function showTypeFiles(string $airlineHash, string $company_document_typeHash)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return redirect()->route('employee.index')->with('warning', 'غير مصرح لك بالإطلاع على المستندات!');
        }

        $airlineId = decodeId($airlineHash);
        if (!$airlineId) {
            return abort(404);
        }
        $airline = Airline::findOrFail($airlineId);

        $document_typeId = decodeId($company_document_typeHash);
        if (!$document_typeId) {
            return abort(404);
        }
        $document_type = Company_document_type::findOrFail($document_typeId);

        $airlines = Airline::all();
        $company_document_types = Company_document_type::all();

        $company_documents = Company_document::where('airline_id', $airline->id)
                                     ->where('company_document_type_id', $document_type->id)
                                     ->orderByDesc('created_at')->get();
        return view('user.company-docs.show', compact('company_documents', 'airline', 'airlines', 'company_document_types'));
    }

    public function officePreview($id)
    {
        if (!Auth::user()->hasPermission('showDocuments')) {
            return redirect()->route('employee.index')->with('warning', 'غير مصرح لك بالإطلاع على المستندات!');
        }

        if (!Auth::user()->hasPermission('previewDocuments')) {
            return back()->with('warning', 'غير مصرح لك بمعاينة المستندات!');
        }

        $company_document = Company_document::findOrFail($id);
        $fullpath = storage_path('app/public/' . $company_document->file_path);

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
            'Content-Disposition' => 'inline; filename="' . $company_document->original_name . '"',
        ]);
    }
}
