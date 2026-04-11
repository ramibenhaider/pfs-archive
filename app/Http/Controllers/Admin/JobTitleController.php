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
        $data = $request->validate([
            'job_title_name' => 'required|string|max:70'
        ],[
            'job_title_name.reqired' => 'الاسم مطلوب!',
            'job_title_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!'
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
    public function update(Request $request, Job_title $job_title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job_title $job_title)
    {
        //
    }
}
