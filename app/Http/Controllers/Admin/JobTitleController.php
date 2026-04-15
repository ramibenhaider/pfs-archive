<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job_title;
use Illuminate\Http\Request;

class JobTitleController extends Controller
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
        $data = $request->validateWithBag('job_title_name.create',
        [
            'job_title_name' => 'required|string|max:70|unique:job_titles,job_title_name'
        ],
        [
            'job_title_name.reqired' => 'الاسم مطلوب!',
            'job_title_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'job_title_name.unique' => 'المسمى الوظيفي مكرر!'
        ]);
        Job_title::create($data);
        return redirect()->back()->with('success', 'تم إضافة اسم المسمى الوظيفي بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job_title $job_title)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job_title $job_title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $job_titleHashed)
    {
        $job_titleHashed = decodeId($job_titleHashed);
        if(!$job_titleHashed) {
            abort(404);
        }
        $job_title = job_title::findOrFail($job_titleHashed);

        $new_data = $request->validateWithBag('job_title_name.edit',
        [
            'job_title_name' => 'required|string|max:70|unique:job_titles,job_title_name',
        ],
        [
            'job_title_name.required' => 'لا يمكن ترك هذه الخانة فارغ فارغة!',
            'job_title_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'job_title_name.unique' => 'المسمى الوظيفي مكرر!'
        ]);

        if (!$job_title->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $job_title->save();
        return redirect()->back()->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($job_titleHashed)
    {
        $job_titleHashed = decodeId($job_titleHashed);

        if(!$job_titleHashed) {
            abort(404);
        }

        $job_title = job_title::findOrFail($job_titleHashed);

        if ($job_title->employees()->exists()) {
            return back()->with('warning', 'يجب أن لا يكون هناك موظف مرتبط بهذا المسمى الوظيفي!');
        }

        $job_title->delete();

        return back()->with('success', 'تم حذف المسمى الوظيفي بنجاح بنجاح');
    }
}
