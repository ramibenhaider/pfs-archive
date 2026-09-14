<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyDocumentTypeStore extends FormRequest
{
    protected $errorBag = 'name.create';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:company_document_types,name',
            'nameEn' => 'required|string|regex:/^[a-zA-Z]+$/|max:50|unique:company_document_types,nameEn'
        ];
    }

    public function message()
    {
        return
        [
            'name.required' => 'الاسم مطلوب!',
            'name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'name.unique' => 'هذا الاسم مكرر باللغة العربية!',

            'nameEn.reqired' => 'الاسم مطلوب!',
            'nameEn.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'nameEn.regex' => 'يجب أن تكون هذه الخانة بحروف انجليزية فقط!',
            'nameEn.unique' => 'هذا الاسم مكرر باللغة الانجليزية!'
        ];
    }
}
