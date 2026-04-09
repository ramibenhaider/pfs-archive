<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Employee;
use App\Models\Job_title;
use Illuminate\Http\Request;
use App\Models\Document_type;
use App\Models\Management;
use App\Models\Nationality;
use App\Models\Document;
use App\Models\Note;
use Illuminate\Validation\Rule;

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
        $airlines = Airline::all();
        $job_titles = Job_title::all();
        return view('employee.create', compact('management', 'nationalities', 'document_types', 'airlines', 'job_titles'));
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
            'is_active'       => 'nullable',
            'airline_id'      => 'nullable',
            'job_title_id'    => 'nullable'
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
            'phone_number.unique' => 'رقم الجوال مكرر!'
        ]);
        Employee::create($data);
        return redirect()->route('index')->with('success', 'تمت إضافة الموظف بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {   $managements = Management::all();
        $nationalities = Nationality::all();
        $airlines = Airline::all();
        $job_titles = Job_title::all();
        $documents = Document::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        $notes = Note::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        $documentTypes = Document_type::withCount(['documents' => function ($query) use ($employee) {
            $query->where('employee_id', $employee->id);
        }])->orderByDesc('created_at')->get();

        return view('employee.show', compact('employee', 'documents', 'notes', 'managements', 'nationalities', 'documentTypes', 'job_titles', 'airlines'));
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
        $is_active = $request->has('is_active') ? 1 : 0;
        
        if ($request->filled('passport_number'))
            {
                $request->merge([ 'passport_number' => strtoupper($request->passport_number)]);
            }
        $new_data = $request->validate([
            'name'            => 'required|string|min:2',
            'job_number'      => ['nullable', 'string', 'between:5,6',
                                    Rule::unique('employees', 'job_number')->ignore($employee->id)],
            'management_id'   => 'nullable|integer',
            'passport_number' => ['nullable', 'string', 'regex:/^[A-Z0-9]{6,9}$/',
                                    Rule::unique('employees', 'passport_number')->ignore($employee->id)],
            'id_number'       => ['nullable', 'numeric', 'digits:10',
                                    Rule::unique('employees', 'id_number')->ignore($employee->id)],
            'expiry_date_id'  => 'nullable|date|after:today',
            'phone_number'    => ['nullable', 'digits:10',
                                    Rule::unique('employees', 'phone_number')->ignore($employee->id)],
            'nationality_id'  => 'nullable|integer',

            'airline_id'      => 'nullable|integer',

            'job_title_id'    => 'nullable|integer'
        ],
        [
            'name.required' => 'لا يمكن ترك الاسم فارغاً!',
            'name.min' => 'يجب أن يكون الاسم من حرفين على الأقل!',

            'job_number.between' => 'يجب أن يكون الرقم الوظيفي من 5 أو 6 خانات!',
            'job_number.unique' => 'هذا الرقم الوظيفي مسجل من قبل!',
            
            'passport_number.regex' => 'رقم الجواز يجب أن يكون: من 6 إلى 9 خانات - لا يحتوى إلا على أرقام أو حروف انجليزية',
            'passport_number.unique' => 'رقم جواز السفر مسجل من قبل!',

            'id_number.digits' => 'رقم الهوية مكون من 10 أرقام بالضبط!',
            'id_number.unique' => 'رقم الهوية مكرر!',

            'expiry_date_id.after' => 'الهوية منتهية!',

            'phone_number.digits' => 'رقم الجوال يجب أن يتكون من 10 أرقام بالضبط!',
            'phone_number.unique' => 'رقم الجوال مكرر!'
        ]);
        $new_data['is_active'] = $is_active;

        if (!$employee->fill($new_data)->isDirty()) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        $employee->update($new_data);

        return redirect()->route('employee.show', $employee->id)->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
