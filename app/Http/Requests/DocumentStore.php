<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Document_type;
use Illuminate\Auth\Access\AuthorizationException;
class DocumentStore extends FormRequest
{
    protected $errorBag = 'doc_errors';
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!Auth::user()->hasPermission('createDocuments')) {
            return false;
        }

        $document_type = Document_type::find($this->document_type_id);
        if (!$document_type) {
            return false;
        }

        return true;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('غير مصرح لك بإضافة مستندات!');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'files' => 'required|array',
                'files.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',

                'employee_id' => 'required|exists:employees,id',
                'document_type_id' => 'required|exists:document_types,id',

                'comments' => 'array',
                'comments.*' => 'nullable|string|max:255',
        ];
    }

    public function message()
    {
        return [
                'files.required' => 'يجب رفع ملف واحد على الأقل!',
                'files.*.required' => 'يجب رفع ملف واحد على الأقل!',
                'files.*.file' => 'الملف المرفوع غير صالح!',
                'files.*.mimes' => 'الملفات المدعومة هي: PDF وWord وExcel!',
                'files.*.max' => 'حجم الملف يجب ألا يتجاوز 10 ميجابايت!',

                'employee_id.required' => 'يجب تحديد الموظف!',
                'employee_id.exists' => 'لا يوجد هذا الموظف في قاعدة البيانات!',

                'comments.*.max' => 'لقد تجاوزت الحد المسموح من الحروف!',
        ];
    }
}
