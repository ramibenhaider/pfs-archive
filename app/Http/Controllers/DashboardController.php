<?php

namespace App\Http\Controllers;
use App\Models\Employee;
Use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function home()
    {
        $employee = Employee::orderBy('created_at', 'desc')->get();
        return view('index', compact('employee'));
    }

    public function makeSearch(Request $request)
    {
        $search = $request->search;
        $employee = Employee::orderBy('created_at', 'desc')
                            ->where('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('job_number', 'LIKE', $search.'%')
                            ->orWhere('id_number', 'LIKE', $search.'%')
                            ->get();
        return view('index', compact('employee'));
    }
}
