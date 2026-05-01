<?php

namespace App\Http\Controllers\Api\User;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:150'],
            'note'        => ['nullable', 'string', 'max:255'],
        ],
        [
            'title.required' => 'يجب إضافة عنوان!',
            'title.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',

            'note.max' => 'لقد تجاوزت عدد الأحرف المسموحة'
        ]);
        $storedData = MyNote::create([...$data, 'user_id' => auth()->id()]);
        return response()->json([
            'status' => 'success',
            'message' => 'تمت إضافة ملاحظتك بنجاح!',
            'data' => $storedData
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($HashedId)
    {
        $decodedId = decodeId($HashedId);

        if (!$decodedId)
        return abort(404);

        $myNote = MyNote::findOrFail($decodedId);

        return response()->json(['data' => $myNote],200);
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

            'note.max' => 'لقد تجاوزت عدد الأحرف المسموحة'
        ]);

        if (!$myNote->fill($new_data)->isDirty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'لم تقم بأي تعديل!'
            ],422);
        }

        $myNote->update($new_data);
        return response()->json([
            'status' => 'success',
            'message' => 'تم التعديل بنجاح!',
            'data' => $myNote
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = MyNote::findOrFail($id);

        $note->delete();
        return response()->noContent();
    }
}
