<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document_type;
use App\Models\Document;
use App\Models\Employee;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($employeeHash,$document_typeHash)
    {
        $employeeId = decodeId($employeeHash);
        if (!$employeeId) {
            return abort(404);
        }
        $employee = Employee::findOrFail($employeeId);

        $document_typeId = decodeId($document_typeHash);
        if (!$document_typeId) {
            return abort(404);
        }
        $document_type = Document_type::findOrFail($document_typeId);

        $documents = Document::where('employee_id', $employee->id)
                             ->where('document_type_id', $document_type->id)
                             ->orderByDesc('created_at')->get();
        return view('user.document.show', compact('documents', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document_type $document_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document_type $document_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document_type $document_type)
    {
        //
    }
}
