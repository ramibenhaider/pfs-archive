<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Document_type;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->get();
        $notes = Note::orderBy('created_at', 'desc')->get();
        $documents = Document::all();
        $document_types = Document_type::all();
        return view('library.index', compact('documents', 'notes', 'employees', 'document_types'));
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
            'employee_id' => ['required', 'exists:employees,id'],
            'title'       => ['required', 'string', 'max:100'],
            'note'        => ['nullable', 'string', 'max:255'],
        ],
        [
            'employee_id.required' => 'يجب تحديد إلى من تعود الملاحظة!',
            'employee_id.exists'   => 'لا يوجد هذا الموظف في قاعدة البيانات!',

            'title.required' => 'يجب إضافة عنوان!',
            'title.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',

            'note' => 'لقد تجاوزت عدد الأحرف المسموحة'
        ]);
        Note::create($data);
        return back()->with('sucsess', 'تمت إضافة الملاحظة بنجاح!');
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

    public function doSearch(Request $request)
    {
        if(!$request->filled('employee_id')) {
            return redirect()->route('library.index');
        }
        $request->validate([
            'employee_id' => 'required|exists:employees,id'
        ],
        [
            'employee_id.required' => 'اسم الموظف مطلوب!',
            'employee_id.exists'   => 'هذا الموظف غير مسجل على قاعدة البيانات!'
        ]);

        $notes = Note::with('employee')
                      ->where('employee_id', $request->employee_id)
                      ->orderByDesc('created_at')
                      ->get();
        $employees = Employee::orderByDesc('created_at')->get();
        $documents = Document::all();
        $document_types = Document_type::all();
        return view('library.index', compact('notes', 'employees', 'documents', 'document_types'))
               ->with('success');
    }
}
