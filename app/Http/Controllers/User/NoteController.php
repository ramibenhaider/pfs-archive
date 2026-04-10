<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $notes = Note::orderBy('created_at', 'desc')->paginate(5);
        $documents = Document::all();
        $document_types = Document_type::all();
        return view('user.library.index', compact('documents', 'notes', 'employees', 'document_types'));
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
        $data = $request->validateWithBag('note_errors', [
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
    public function edit(string $noteHash)
    {
        $hashedNote = decodeId($noteHash);
        if (!$hashedNote) {
            abort(404);
        }
        $note = Note::findOrFail($hashedNote);
        return view('user.notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $new_data = $request->validate([
            'title'       => ['required', 'string', 'max:100'],
            'note'        => ['nullable', 'string', 'max:255'],
        ],
        [
            'title.required' => 'لا يمكن ترك العنوان فارغاً!',
            'title.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',

            'note' => 'لقد تجاوزت عدد الأحرف المسموحة'
        ]);

        if (!$note->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $note->save();
        return redirect()->route('user.employee.show', encodeId($note->employee->id))->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return back()->with('success', 'تم الحذف بنجاح!');
    }

    public function doSearch(Request $request)
    {
        if(!$request->filled('employee_id')) {
            return redirect()->route('user.library.index');
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
                      ->paginate(5);
        $employees = Employee::orderByDesc('created_at')->get();
        $documents = Document::all();
        $document_types = Document_type::all();
        return view('user.library.index', compact('notes', 'employees', 'documents', 'document_types'))
               ->with('success');
    }
}
