<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Document_type;
use App\Models\Management;
use App\Models\Nationality;
use App\Models\Document;
use App\Models\Note;

class EmployeeController extends Controller
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
        $management = Management::all();
        $nationalities = Nationality::all();
        $document_types = Document_type::all();
        $documents = Document::all();
        return view('employee.create', compact('management', 'nationalities', 'document_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $is_active = $request->has('is_active') ? 1 : 0;
        
        if ($request->filled('passport_number'))
            {
                $request->merge([ 'passport_number' => strtoupper($request->passport_number)]);
            }
        $data = $request->validate([
            'name'            => ['required', 'string', 'min:2'],
            'job_number'      => ['nullable', 'string', 'between:5,6', 'unique:employees,job_number'],
            'management_id'   => ['nullable', 'integer'],
            'passport_number' => ['nullable', 'string', 'regex:/^[A-Z0-9]{6,9}$/', 'unique:employees,passport_number'],
            'id_number'       => ['nullable', 'numeric', 'digits:10', 'unique:employees,id_number'],
            'expiry_date_id'  => ['nullable', 'date', 'after:today'],
            'phone_number'    => ['nullable', 'digits:10', 'unique:employees,phone_number'],
            'nationality_id'  => ['nullable', 'integer'],
            'is_active'       => 'nullable'
        ],
        [
            'name.required' => 'يجب إدخال الاسم!',
            'name.min' => 'يجب أن يكون الاسم من حرفين على الأقل!',

            'job_number.between' => 'يجب أن يكون الرقم الوظيفي من 5 أو 6 خانات!',
            'job_number.unique' => 'هذا الرقم الوظيفي مسجل من قبل!',
            
            'passport_number.regex' => 'رقم الجواز يجب أن يكون: من 6 إلى 9 خانات - لا يحتوى إلا على أرقام أو حروف انجليزية',
            'passport_number.unique' => 'رقم جواز السفر مسجل من قبل!',

            'id_number.digits' => 'رقم الهوية مكون من 10 أرقام بالضبط!',
            'id_number.unique' => 'رقم الهوية مكرر!',

            'expiry_date_id.after' => 'الهوية منتهية!',

            'phone_number.digits' => 'رقم الجوال يجب أن يتكون من 10 أرقام بالضبط!',
            'phone_number.uniqe' => 'رقم الجوال مكرر!'
        ]);
        Employee::create($data);
        return redirect()->route('index')->with('success', 'تمت إضافة الموظف بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {   
        $documents = Document::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        $notes = Note::where('employee_id', $employee->id)->orderByDesc('created_at')->get();

        return view('employee.show', compact('employee', 'documents', 'notes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
