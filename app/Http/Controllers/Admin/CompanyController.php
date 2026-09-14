<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        $data = $request->validateWithBag('company_name.create',
        [
            'company_name' => 'required|string|max:70|unique:companies,company_name'
        ],
        [
            'company_name.reqired' => 'الاسم مطلوب!',
            'company_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'company_name.unique' => 'اسم الشركة مكرر!'
        ]);

        Company::create($data);
        return redirect()->back()->with('success', 'تم إضافة اسم الشركة بنجاح');
    }
    public function update(Request $request, $companyHashed)
    {
        $companyHashed = decodeId($companyHashed);
        if(!$companyHashed) {
            abort(404);
        }
        $company = company::findOrFail($companyHashed);
        $new_data = $request->validateWithBag('company_name.edit',
        [
            'company_name' => 'required|string|max:70|unique:companies,company_name',
        ],
        [
            'company_name.required' => 'لا يمكن ترك هذه الخانة فارغ فارغة!',
            'company_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'company_name.unique' => 'اسم الشركة مكرر!'
        ]);

        if (!$company->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $company->save();
        return redirect()->back()->with('success', 'تم التعديل بنجاح!');
    }
    public function destroy(string $companyHashed)
    {
        $companyHashed = decodeId($companyHashed);

        if(!$companyHashed) {
            abort(404);
        }
        
        $company = company::findOrFail($companyHashed);
        
        if ($company->employees()->exists()) {
            return back()->with('warning', 'يجب أن لا يكون هناك موظف مرتبط بهذه الشركة لإتمام عملية الحذف!');
        }

        $company->delete();

        return back()->with('success', 'تم حذف الشركة بنجاح');
    }
}
