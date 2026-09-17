<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Job_title;
use Illuminate\Http\Request;
use App\Models\Document_type;
use App\Models\Management;
use App\Models\Nationality;
use App\Models\Document;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use App\Services\EmployeeService;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user() && !auth()->user()->is_active) {
            return redirect()->route('user.unactivated');
        }
        
        $employee = $this->employeeService->getPaginatedEmployees(6);
        return view('user.index', compact('employee'));
    }

    public function create()
    {
        if (!Auth::user()->hasPermission('createEmployees')) {
            return redirect()->route('employee.index')->with('warning', 'غير مصرح لك بإضافة موظف');
        }

        $management = Management::all();
        $nationalities = Nationality::all();
        $document_types = Document_type::all();
        $companies = Company::all();
        $job_titles = Job_title::all();
        return view('user.employee.create', compact('management', 'nationalities', 'document_types', 'companies', 'job_titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $this->employeeService->createEmployee($request->validated());
        return redirect()->route('employee.index')->with('success', 'تمت إضافة الموظف بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $employeeHash)
    {
        $employeeId = decodeId($employeeHash);
        if (!$employeeId) {
            abort(404);
        }
        $employee = $this->employeeService->getEmployeeById($employeeId);

        $managements = Management::all();
        $nationalities = Nationality::all();
        $companies = Company::all();
        $job_titles = Job_title::all();
        $documents = Document::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        $notes = Note::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        $documentTypes = Document_type::withCount(['documents' => function ($query) use ($employee) {
            $query->where('employee_id', $employee->id);
        }])->orderByDesc('created_at')->get();

        return view('user.employee.show', compact('employee', 'documents', 'notes', 'managements', 'nationalities', 'documentTypes', 'job_titles', 'companies'));
    }

    public function show(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $updated = $this->employeeService->updateEmployee($employee, $request->validated());

        if (!$updated) {
            return back()->with('warning', 'لم تقم بأي تعديل!');
        }

        return redirect()->route('employee.edit', encodeId($employee->id))->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if (!Auth::user()->hasPermission('deleteEmployees')) {
            return back()->with('warning', 'غير مصرح لك بحذف موظف');
        }

        $this->employeeService->deleteEmployee($employee);

        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف بنجاح');
    }

    public function doSearch(Request $request)
    {
        $search = $request->search;
        $employee = $this->employeeService->searchEmployees($search);
        
        return view('user.index', compact('employee'));
    }
}
