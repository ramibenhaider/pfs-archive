<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
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
        $data = $request->validateWithBag('nationality_name.create',
        [
            'nationality_name' => 'required|string|max:30|unique:nationalities,nationality_name'
        ],
        [
            'nationality_name.reqired' => 'الاسم مطلوب!',
            'nationality_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'nationality_name.unique' => 'الجنسية مكررة!'
        ]);

        nationality::create($data);
        return redirect()->back()->with('success', 'تم إضافة اسم الجنسية بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nationality $nationality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nationality $nationality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $nationality)
    {
        $nationalityHashed = decodeId($nationality);
        if(!$nationalityHashed) {
            abort(404);
        }
        $nationality = Nationality::findOrFail($nationalityHashed);

        $new_data = $request->validateWithBag('nationality_name.edit',
        [
            'nationality_name' => 'required|string|max:30|unique:nationalities,nationality_name',
        ],
        [
            'nationality_name.required' => 'لا يمكن ترك هذه الخانة فارغ فارغة!',
            'nationality_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'nationality_name.unique' => 'الجنسية مكررة!'
        ]);

        if (!$nationality->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $nationality->save();
        return redirect()->back()->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nationality)
    {
        $nationalityHashed = decodeId($nationality);

        if(!$nationalityHashed) {
            abort(404);
        }

        $nationality = Nationality::findOrFail($nationalityHashed);

        if ($nationality->employees()->exists()) {
            return back()->with('warning', 'يجب أن لا يكون هناك موظف مرتبط بهذه الجنسية!');
        }

        $nationality->delete();

        return back()->with('success', 'تم حذف الجنسية بنجاح');
    }
}
