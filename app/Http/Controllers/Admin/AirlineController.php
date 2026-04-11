<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
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
            'airline_name' => 'required|string|max:70'
        ],[
            'airline_name.reqired' => 'الاسم مطلوب!',
            'airline_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!'
        ]);

        Airline::create($data);
        return redirect()->back()->with('success', 'تم إضافة اسم خطوط الطيران بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Airline $airline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airline $airline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airline $airline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airline $airline)
    {
        //
    }
}
