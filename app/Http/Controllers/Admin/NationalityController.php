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
        $data = $request->validate([
            'nationality_name' => 'required|string|max:30'
        ],[
            'nationality_name.reqired' => 'الاسم مطلوب!',
            'nationality_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!'
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
    public function update(Request $request, Nationality $nationality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nationality $nationality)
    {
        //
    }
}
