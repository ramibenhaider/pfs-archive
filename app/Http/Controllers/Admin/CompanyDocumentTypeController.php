<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company_document_type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CompanyDocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validateWithBag('name.create',
        [
            'name' => 'required|string|max:50|unique:company_document_types,name',
            'nameEn' => 'required|string|regex:/^[a-zA-Z]+$/|max:50|unique:company_document_types,nameEn'
        ],
        [
            'name.required' => 'الاسم مطلوب!',
            'name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'name.unique' => 'هذا الاسم مكرر باللغة العربية!',

            'nameEn.reqired' => 'الاسم مطلوب!',
            'nameEn.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'nameEn.regex' => 'يجب أن تكون هذه الخانة بحروف انجليزية فقط!',
            'nameEn.unique' => 'هذا الاسم مكرر باللغة الانجليزية!'
        ]);

        Storage::disk('public')->makeDirectory($request->nameEn);

        Company_document_type::create($data);
        return redirect()->back()->with('success', 'تم إضافة اسم نوع المستند بنجاح');
    }

    public function update(Request $request, String $company_document_typeHashed)
    {
        $company_document_typeDecoded = DecodeId($company_document_typeHashed);
        if (!$company_document_typeDecoded) {
            abort(404);
        }
        $company_document_type = Company_document_type::findOrFail($company_document_typeDecoded);
        $new_data = $request->validateWithBag('name.edit',
        [
            'name' => 'required|string|max:50|unique:company_document_types,name',
        ],
        [
            'name.required' => 'لا يمكن ترك هذه الخانة فارغ فارغة!',
            'name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'name.unique' => 'هذا الاسم مكرر باللغة العربية!'

        ]);

        if (!$company_document_type->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $company_document_type->save();
        return back()->with('success', 'تم التعديل بنجاح!');
    }

    public function destroy(string $company_document_typeHashed)
    {
        $company_document_typeDecoded = DecodeId($company_document_typeHashed);

        if (!$company_document_typeDecoded) {
            abort(404);
        }

        $company_document_type = Company_document_type::findOrFail($company_document_typeDecoded);

        if ($company_document_type->company_documents()->exists()) {
            return back()->with('warning', 'يجب أن لا يكون هناك مستند مرتبط بهذا النوع!');
        }

        Storage::disk('public')->deleteDirectory($company_document_type->nameEn);

        $company_document_type->delete();
        
        return back()->with('success', 'تم حذف نوع المستند بنجاح');
    }
}
