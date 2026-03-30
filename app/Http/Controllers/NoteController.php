<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Document;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('notes.index');
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

        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'employee_id' => 'required|exists:employees,id',
            'document_type_id' => 'required|exists:document_types,id'
        ]);

        $paths = [];

        foreach ($request->file('images') as $image) {
            $paths[] = $image->store('uploads', 'public');
        }

        // مثال: تخزين المسارات في جدول واحد
        Document::insert(
            collect($paths)->map(fn($p) => ['file_path' => $p,
                                            'employee_id' => $request->employee_id,
                                            'document_type_id' => $request->document_type_id
                                            ])->toArray()
    );

    return back()->with('success', 'تم رفع الصور بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
