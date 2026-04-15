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
        $data = $request->validateWithBag('airline_name.create',
        [
            'airline_name' => 'required|string|max:70|unique:airlines,airline_name'
        ],
        [
            'airline_name.reqired' => 'الاسم مطلوب!',
            'airline_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'airline_name.unique' => 'اسم خط الطيران مكرر!'
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
    public function update(Request $request, $airlineHashed)
    {
        $airlineHashed = decodeId($airlineHashed);
        if(!$airlineHashed) {
            abort(404);
        }
        $airline = airline::findOrFail($airlineHashed);
        $new_data = $request->validateWithBag('airline_name.edit',
        [
            'airline_name' => 'required|string|max:70|unique:airlines,airline_name',
        ],
        [
            'airline_name.required' => 'لا يمكن ترك هذه الخانة فارغ فارغة!',
            'airline_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'airline_name.unique' => 'اسم خط الطيران مكرر!'
        ]);

        if (!$airline->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $airline->save();
        return redirect()->back()->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($airlineHashed)
    {
        $airlineHashed = decodeId($airlineHashed);

        if(!$airlineHashed) {
            abort(404);
        }
        
        $airline = airline::findOrFail($airlineHashed);
        
        if ($airline->employees()->exists()) {
            return back()->with('warning', 'يجب أن لا يكون هناك موظف مرتبط بخط الطيران هذا!');
        }

        $airline->delete();

        return back()->with('success', 'تم حذف خط الطيران بنجاح');
    }
}
