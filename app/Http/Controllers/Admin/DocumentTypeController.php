<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document_type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validateWithBag('type.create',
        [
            'type' => 'required|string|max:50|unique:document_types,type',
            'typeEn' => 'required|string|regex:/^[a-zA-Z]+$/|max:50|unique:document_types,typeEn'
        ],
        [
            'type.required' => 'الاسم مطلوب!',
            'type.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'type.unique' => 'هذا الاسم مكرر باللغة العربية!',

            'typeEn.reqired' => 'الاسم مطلوب!',
            'typeEn.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'typeEn.regex' => 'يجب أن تكون هذه الخانة بحروف انجليزية فقط!',
            'typeEn.unique' => 'هذا الاسم مكرر باللغة الانجليزية!'
        ]);

        Storage::disk('public')->makeDirectory($request->typeEn);

        Document_type::create($data);
        return redirect()->back()->with('success', 'تم إضافة اسم نوع المستند بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document_type $document_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document_type $document_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $document_typeHashed)
    {
        $document_typeDecoded = DecodeId($document_typeHashed);
        if (!$document_typeDecoded) {
            abort(404);
        }
        $document_type = Document_type::findOrFail($document_typeDecoded);
        $new_data = $request->validateWithBag('type.edit',
        [
            'type' => 'required|string|max:50|unique:document_types,type',
        ],
        [
            'type.required' => 'لا يمكن ترك هذه الخانة فارغ فارغة!',
            'type.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'type.unique' => 'هذا الاسم مكرر باللغة العربية!'

        ]);

        if (!$document_type->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $document_type->save();
        return back()->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($document_typeHashed)
    {
        $document_typeDecoded = DecodeId($document_typeHashed);

        if (!$document_typeDecoded) {
            abort(404);
        }

        $document_type = Document_type::findOrFail($document_typeDecoded);

        if ($document_type->documents()->exists()) {
            return back()->with('warning', 'يجب أن لا يكون هناك مستند مرتبط بهذا النوع!');
        }

        Storage::disk('public')->deleteDirectory($document_type->typeEn);

        $document_type->delete();
        
        return back()->with('success', 'تم حذف نوع المستند بنجاح');
    }
}
