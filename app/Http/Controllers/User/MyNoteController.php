<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MyNote;
use Illuminate\Http\Request;

class MyNoteController extends Controller
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
        return view('user.notes.createMyNote');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validateWithBag('note_errors', [
            'title'       => ['required', 'string', 'max:150'],
            'note'        => ['nullable', 'string', 'max:255'],
        ],
        [
            'title.required' => 'يجب إضافة عنوان!',
            'title.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',

            'note' => 'لقد تجاوزت عدد الأحرف المسموحة'
        ]);
        MyNote::create([...$data, 'user_id' => auth()->id()]);
        return redirect()->route('note.index')->with('success', 'تمت إضافة ملاحظتك بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($HashedId)
    {
        $decodedId = decodeId($HashedId);

        if(!$decodedId) {
            return abort(404);
        }

        $myNote = MyNote::findOrFail($decodedId);

        return view('user.notes.editMyNote', compact('myNote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyNote $myNote)
    {
        $new_data = $request->validate([
            'title'       => ['required', 'string', 'max:150'],
            'note'        => ['nullable', 'string', 'max:255'],
        ],
        [
            'title.required' => 'لا يمكن ترك العنوان فارغاً!',
            'title.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',

            'note' => 'لقد تجاوزت عدد الأحرف المسموحة'
        ]);

        if (!$myNote->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $myNote->save();
        return back()->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = MyNote::findOrFail($id);

        $note->delete();
        return redirect()->route('note.index')->with('success', 'تم الحذف بنجاح!');
    }
}
