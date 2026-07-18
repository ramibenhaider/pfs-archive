<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CompanyDocumentStore extends FormRequest
{
protected $errorBag = 'company_doc_errors';

    public function authorize(): bool
    {

        if (!Auth::user()->hasPermission('showDocuments')) {
            return redirect()->route('employee.index')->with('warning', 'غير مصرح لك بعرض مستندات الشركات!');
        }

        if (!Auth::user()->hasPermission('createDocuments')) {
            return back()->with('warning', 'غير مصرح لك بإضافة مستندات!');
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'files' => 'required|array',
            'files.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',

            'airline_id' => 'required|exists:airlines,id',
            'company_document_type_id' => 'required|exists:company_document_types,id',

            'comments' => 'array',
            'comments.*' => 'nullable|string|max:255',
        ];
    }

    public function message()
    {
        return
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
        ];
    }
}
