<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\MyNote;
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
        $myNotes = MyNote::where('user_id', auth()->id())->orderByDesc('created_at')->paginate(5);
        $employees = Employee::orderByDesc('created_at')->get();
        $documents = Document::all();
        $document_types = Document_type::all();
        return response()->json([
            'myNotes' => $myNotes,
            'employees' => $employees,
            'documents' => $documents,
            'document_types' => $document_types,
        ]);
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

            'note.max' => 'لقد تجاوزت عدد الأحرف المسموحة'
        ]);

        $note = Note::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'تمت إضافة الملاحظة بنجاح!',
            'data' => $note,
        ], 201);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $noteHash)
    {
        $hashedNote = decodeId($noteHash);
        if (!$hashedNote) {
            abort(404);
        }
        $note = Note::findOrFail($hashedNote);

        return response()->json($note);
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

            'note.max' => 'لقد تجاوزت عدد الأحرف المسموحة'
        ]);

        if (!$note->fill($new_data)->isDirty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'لم تقم بأي تعديل!',
            ], 400);
        }

        $note->update($new_data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم التعديل بنجاح!',
            'data' => $note,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);

        $note->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم الحذف بنجاح!',
        ]);
    }
}
