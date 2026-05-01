<?php

namespace App\Http\Controllers\Api\User;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user() && !auth()->user()->is_active) {
            return response()->json([
                'status' => 'warning',
                'message' => 'حسابك قيد المراجعة!'
            ],401);
        }
        
        $employee = Employee::orderBy('created_at', 'desc')->paginate(6);
        return response()->json([
            'status' => 'success',
            'data' => $employee
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasPermission('createEmployees')) {
            return response()->json([
                'status' => 'warning',
                'message' => 'غير مصرح لك بإضافة موظف!'
            ], 403);
        }

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
        return response()->json([
            'status' => 'success',
            'message' => 'تمت إضافة الموظف بنجاح!'
        ], 200);
    }

    public function show($employeeHash)
    {
        // $encoded = encodeId($employeeHash);
        // return response()->json(['hashed number' => $encoded]);
        $employeeId = decodeId($employeeHash);
        if (!$employeeId) {
            return response()->json(['message' => 'no one'],404);
        }
        $employee = Employee::findOrFail($employeeId);

        $management = Management::all();
        $nationalities = Nationality::all();
        $airlines = Airline::all();
        $job_titles = Job_title::all();
        $documents = Document::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        $notes = Note::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        $documentTypes = Document_type::withCount(['documents' => function ($query) use ($employee) {
            $query->where('employee_id', $employee->id);
        }])->orderByDesc('created_at')->get();

        return response()->json([
            'status' => 'success',
            'data'=> ['employee' => $employee,
                      'management' => $management,
                      'nationalities' => $nationalities,
                      'airlines' => $airlines,
                      'job_titles' => $job_titles,
                      'documents' => $documents,
                      'notes' => $notes,
                      'documentTypes' => $documentTypes
            ]
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        if (!Auth::user()->hasPermission('updateEmployees')) {
            return response()->json([
                'status' => 'warning',
                'message' => 'غير مصرح لك بالتعديل على موظف!'
            ], 403);
        }

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
            return response()->json([
                'status' => 'warning',
                'message' => 'لم تقم بأي تعديل!'
            ], 200);
        }

        $employee->update($new_data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم التعديل بنجاح!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if (!Auth::user()->hasPermission('deleteEmployees')) {
            return response()->json([
                'status' => 'warning',
                'message' => 'غير مصرح لك بحذف موظف!'
            ], 403);
        }

        $employee->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف الموظف بنجاح'
        ], 200);
    }

    public function doSearch(Request $request)
    {
        $search = $request->search;
        $normalizedSearch = str_replace(['آ', 'أ', 'إ'], 'ا', $search);
        $employee = DB::table('employees')
            ->where(function ($query) use ($normalizedSearch, $search) {
                $query->whereRaw("REPLACE(REPLACE(REPLACE(
                            name,'آ','ا'), 'أ','ا'), 'إ','ا') LIKE ?", ["%$normalizedSearch%"])
                    ->orWhere('job_number', 'LIKE', $search . '%')
                    ->orWhere('id_number', 'LIKE', $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
            
        return response()->json([
            'status' => 'success',
            'data' => $employee
        ], 200);
    }
}
