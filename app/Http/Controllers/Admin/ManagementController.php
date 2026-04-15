<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Management;
use Illuminate\Http\Request;

class ManagementController extends Controller
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
        $data = $request->validateWithBag('management_name.create',
        [
            'management_name' => 'required|string|max:30|unique:management,management_name'
        ],
        [
            'management_name.reqired' => 'الاسم مطلوب!',
            'management_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'management_name.unique' => 'اسم الإدارة مكرر!'
        ]);

        Management::create($data);
        return redirect()->back()->with('success', 'تم إضافة اسم الإدارة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Management $management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Management $management)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $managementHashed)
    {
        $managementHashed = decodeId($managementHashed);
        if(!$managementHashed) {
            abort(404);
        }
        $management = management::findOrFail($managementHashed);

        $new_data = $request->validateWithBag('management_name.edit',
        [
            'management_name' => 'required|string|max:30|unique:management,management_name',
        ],
        [
            'management_name.required' => 'لا يمكن ترك هذه الخانة فارغ فارغة!',
            'management_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'management_name.unique' => 'اسم الإدارة مكرر!'
        ]);

        if (!$management->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $management->save();
        return redirect()->back()->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($managementHashed)
    {
        $managementHashed = decodeId($managementHashed);

        if(!$managementHashed) {
            abort(404);
        }

        $management = management::findOrFail($managementHashed);

        if ($management->employees()->exists()) {
            return back()->with('warning', 'يجب أن لا يكون هناك موظف مرتبط بهذه الإدارة!');
        }

        $management->delete();

        return back()->with('success', 'تم حذف الإدارة بنجاح');
    }
}
